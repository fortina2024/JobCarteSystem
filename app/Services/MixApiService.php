<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Site;
use Carbon\Carbon;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class MixApiService
{
    protected string $baseUrl;
    protected string $restUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected string $username;
    protected string $password;
    protected string $organisationGroupId;

    public function __construct()
    {
        $config = config('services.mix');

        $this->baseUrl = $config['base_url'];
        $this->restUrl = $config['rest_url'];
        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->organisationGroupId = $config['organisation_group_id'];
    }

    /**
     * Authentifie et retourne un token d'accès, mis en cache.
     */
    public function getAccessToken(): ?string
    {
        return Cache::remember('mix_api_token', now()->addMinutes(50), function () {
            $response = Http::asForm()->post($this->baseUrl . '/connect/token', [
                'grant_type' => 'password',
                'username' => $this->username,
                'password' => $this->password,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'offline_access MiX.Integrate',
            ]);

            if ($response->successful()) {

                return $response['access_token'];
            }

            Log::error('Erreur lors de l’obtention du token MiX Telematics', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        });
    }

    /**
     * Effectue un appel GET authentifié vers l'API REST.
     */
    protected function get(string $endpoint): mixed
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return null;
        }

        // On ajoute organisation_group_id dans header custom si besoin
        $response = Http::withToken($token)
            ->withHeaders([
                'MiX-Organisation-Group-Id' => $this->organisationGroupId,
            ])
            ->get("{$this->restUrl}/{$endpoint}");

        if ($response->successful()) {
            return $response->json();
        }

        Log::error("Erreur lors de l'appel à l'endpoint MiX: {$endpoint}", [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }


    public function syncGroups(): void
    {
       $data = $this->get('organisationgroups');

       if (!is_array($data)) {
           Log::warning('Aucune donnée des groupes reçue depuis l\'API.');
           return;
       }


       foreach ($data as $item) {
           Client::updateOrCreate(
               ['group_id' => $item['GroupId']],
               [
                   'type' => $item['Type'],
                   'nom' => Str::replaceFirst('Africa - Komatel - ', '', $item['Name']),
                   'display_time_zone' => $item['DisplayTimeZone'],
               ]
           );
       }

    }

    public function syncRecusiviteSites(array $groups, int $rootGroupId): void
    {

        foreach ($groups as $group) {
            Site::updateOrCreate(
                ['subgroup_id' => $group['GroupId']],
                [
                    'nom'     => $group['Name'] ?? null,
                    'type'     => $group['Type'] ?? null,
                    'group_id' => $rootGroupId, // ⚠️ toujours la racine ici
                ]
            );

            // Si le groupe contient encore des sous-groupes, appel récursif
            if (!empty($group['SubGroups']) && is_array($group['SubGroups'])) {
                $this->syncRecusiviteSites($group['SubGroups'], $rootGroupId); // 💡 toujours le même rootGroupId
            }
        }
    }  
    
    public function getActions(): array
    {
        return [
            Action::make('syncDatabase')
                ->label('Synchroniser la base')
                ->requiresConfirmation()
                ->action(function () {
                    try {
                        app(MixApiService::class)->syncGroups();

                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Erreur de synchronisation')
                            ->body("Erreur lors de la connexion à l'API : {$e->getMessage()}")
                            ->danger()
                            ->persistent()
                            ->send();
                    }

                    return ;
                }),
        ];
    }

}
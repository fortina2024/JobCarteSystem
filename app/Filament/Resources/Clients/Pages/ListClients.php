<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use App\Services\MixApiService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajouter'),
            Action::make('sync')
                ->label('Synchroniser')
                ->color('primary')
                ->icon('heroicon-o-arrow-path')
                ->requiresConfirmation()
                ->modalHeading('Confirmer la synchronisation')
                ->modalDescription('Êtes-vous sûr de vouloir synchroniser la base de données ? Cette opération mettra à jour les données depuis l’API de mix-telematics')
                ->action(function () {
                    try {

                        $recipient = auth()->user();
                        //app(MixApiService::class)->syncAssetTypes();
                        app(MixApiService::class)->syncGroups();
                       
                        $groups = \App\Models\Client::pluck('nom', 'group_id');

                        /*foreach ($groups as $groupId => $name) {
                            \App\Jobs\SyncMixGroupJob::dispatch($groupId, $name);
                        }*/

                        \Filament\Notifications\Notification::make()
                        ->title('Message de synchronisation')
                        ->body('La synchronisation se fait en arrière-plan.')
                        ->success()
                        ->duration(10000)
                        ->send()
                        ->sendToDatabase($recipient);                       

                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Erreur')
                            ->body("Échec de la synchronisation : {$e->getMessage()}")
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),

        ];
    }

}

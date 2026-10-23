<?php

namespace App\Http\Controllers;

use App\Mail\JobCarteSignedMail;
use App\Models\JobCarte;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobCarteSignatureController extends Controller
{
    public function show(string $token)
    {

        $jobCarte = JobCarte::where('signature_token', $token)
            ->where('signature_status', 'pending')
            ->where('signature_token_expires_at', '>', now())
            ->firstOrFail();

        $signatureLink = route('job-carte.signature', [
            'token' => $jobCarte->signature_token,
        ]);

        return view('job-cartes.signature', [
            'jobCarte' => $jobCarte,
            'signatureLink' => $signatureLink,
        ]);
    }

    public function sign(Request $request, string $token)
    {

        // 1. Valider les données reçues du formulaire
        $validated = $request->validate([
            'signed_by_name' => ['required', 'string', 'max:255'],
            'signature' => [
                'required',
                'string',
                'starts_with:data:image/png;base64,',
                'max:4000000',
            ],
        ]);

        // 2. Retrouver la Job Carte grâce au token
        $jobCarte = JobCarte::where('signature_token', $token)
            ->where('signature_status', 'pending')
            ->whereNotNull('signature_token_expires_at')
            ->where('signature_token_expires_at', '>', now())
            ->firstOrFail();

        // 3. Extraire et décoder l'image Base64
        $prefix = 'data:image/png;base64,';

        $base64 = substr(
            $validated['signature'],
            strlen($prefix)
        );

        $image = base64_decode($base64, true);

        if (
            $image === false ||
            strlen($image) > 2 * 1024 * 1024 ||
            @getimagesizefromstring($image) === false ||
            ! str_starts_with($image, "\x89PNG\r\n\x1a\n")
        ) {
            return back()
                ->withErrors([
                    'signature' => 'L’image de signature est invalide ou trop volumineuse.',
                ])
                ->withInput($request->except('signature'));
        }

        // 4. Générer un chemin unique pour le fichier PNG
        $path = 'signatures/job-cartes/'
            .$jobCarte->id
            .'-'
            .bin2hex(random_bytes(16))
            .'.png';

        // 5. Enregistrer le fichier et mettre à jour la Job Carte
        $disk = Storage::disk('public');

        $saved = $disk->put($path, $image);

        if (! $saved) {
            return back()->withErrors([
                'signature' => 'Impossible d’enregistrer la signature. Réessayez.',
            ]);
        }

        try {
            $result = DB::transaction(function () use ($jobCarte, $validated, $path) {
                // Recharger et verrouiller la ligne pour éviter
                // deux signatures simultanées avec le même token.
                $carte = JobCarte::whereKey($jobCarte->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $carte->trashed() ||
                    $carte->signature_status !== 'pending' ||
                    ! empty($carte->signature_path) ||
                    ! empty($carte->signed_at) ||
                    ! $carte->signature_token_expires_at ||
                    $carte->signature_token_expires_at->isPast()
                ) {
                    return false;
                }

                $carte->update([
                    'signature_path' => $path,
                    'signed_by_name' => $validated['signed_by_name'],
                    'signed_by_email' => $jobCarte->client?->email,
                    'signed_at' => now(),
                    'signature_status' => 'signed',
                ]);

                Notification::make()
                    ->title('Job carte signé'.$jobCarte->client?->nom)
                    ->body($jobCarte->client?->nom.' vient de signer la Job carte N° .'.$jobCarte->num_job_carte)
                    ->success()
                    ->send();

                return true;
            });

            if (! $result) {
                $disk->delete($path);

                return redirect()->route('job-carte.signature.unavailable');
            }

            $emailSent = false;

            if ($jobCarte->client?->email) {
                $jobCarte->refresh();

                try {
                    Mail::to($jobCarte->client->email)
                        ->send(new JobCarteSignedMail($jobCarte));

                    $emailSent = true;
                } catch (\Throwable $mailException) {
                    Log::warning('La signature Job Carte a été enregistrée, mais le courriel de confirmation n’a pas pu être envoyé.', [
                        'job_carte_id' => $jobCarte->id,
                        'recipient' => $jobCarte->client->email,
                        'exception' => $mailException->getMessage(),
                    ]);
                }
            }

        } catch (\Throwable $e) {
            // Supprimer le fichier si l'enregistrement en base échoue.
            $disk->delete($path);
            throw $e;
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $emailSent
                    ? 'Job Carte signée et courriel de confirmation envoyé.'
                    : 'Signature enregistrée. Le courriel de confirmation n’a pas pu être envoyé.',
            ]);
        }

        // 6. Confirmer la signature
        return redirect()
            ->route('job-carte.signature.success');
    }
}

<?php

namespace App\Filament\Resources\JobCartes\Tables;

use App\Filament\Resources\JobCartes\JobCarteResource;
use App\Mail\JobCarteDeletedMail;
use App\Mail\JobCarteSignatureMail;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class JobCartesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('num_job_carte')
                    ->label('N° Job carte')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('num_commande')
                    ->label('N° commande')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('vehicule.identifiant_vehicule')
                    ->label('ID Véhicule')
                    ->searchable()
                    ->sortable(),
                /*TextColumn::make('site.asset.Description')
                    ->label('Description')
                    ->searchable()
                    ->sortable(),*/
                TextColumn::make('client.nom')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('signature_status')
                    ->label('Signature')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending' => '🟡 En attente',
                        'signed' => '🟢 Signée',
                        'expired' => '🔴 Expirée',
                        default => '⚪ Non définie',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'pending' => 'warning',
                        'signed' => 'success',
                        'expired' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('user.name')
                    ->label('Technicien')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Archivée le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function ($query): void {
                if (! (auth()->user()?->hasRole('super_admin') ?? false)) {
                    $query->withoutTrashed();
                }
            })
            ->filters([
                TrashedFilter::make()
                    ->visible(fn (): bool => auth()->user()?->hasRole('super_admin') ?? false),
            ])
            ->recordActions([
                ActionGroup::make([
                    RestoreAction::make()
                        ->visible(fn ($record): bool => (auth()->user()?->hasRole('super_admin') ?? false) && $record->trashed()),

                    EditAction::make()
                        ->color('warning')
                        ->visible(fn ($record): bool => ! $record->trashed() && $record->signature_status !== 'signed'),
                    Action::make('afficher')
                        ->label('Afficher')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->visible(fn ($record): bool => ! $record->trashed())
                        ->url(fn ($record) => JobCarteResource::getUrl('fiche', [
                            'record' => $record->getKey(),
                        ])),

                    Action::make('pdf')
                        ->label('PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('gray')
                        ->visible(fn ($record): bool => ! $record->trashed())
                        ->url(fn ($record) => route('job-cartes.pdf', $record))
                        ->openUrlInNewTab(),
                        
                    Action::make('supprimer')
                        ->label('Supprimer')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Archiver la Job Carte')
                        ->modalDescription(fn ($record): string => $record->signature_status === 'signed'
                            ? 'Cette Job Carte est signée. Un courriel sera envoyé au client avant son archivage.'
                            : 'Cette Job Carte sera archivée. Son historique et ses données associées seront conservés.')
                        ->visible(fn ($record): bool => ! $record->trashed() && (auth()->user()?->hasRole('super_admin') ?? false))
                        ->action(function ($record): void {
                            abort_unless(auth()->user()?->hasRole('super_admin'), 403);

                            if ($record->signature_status === 'signed') {
                                $client = $record->client;

                                if (! $client?->email) {
                                    Notification::make()
                                        ->title('Archivage impossible')
                                        ->body('Le client n’a pas d’adresse e-mail. La Job Carte n’a pas été archivée.')
                                        ->danger()
                                        ->send();

                                    return;
                                }

                                try {
                                    Mail::to($client->email)->send(new JobCarteDeletedMail($record));
                                } catch (Throwable $exception) {
                                    Log::error('Impossible de notifier le client avant archivage de la Job Carte.', [
                                        'job_carte_id' => $record->id,
                                        'recipient' => $client->email,
                                        'exception' => $exception->getMessage(),
                                    ]);

                                    Notification::make()
                                        ->title('Archivage impossible')
                                        ->body('Le courriel au client n’a pas pu être envoyé. La Job Carte n’a pas été archivée.')
                                        ->danger()
                                        ->send();

                                    return;
                                }
                            }

                            DB::transaction(function () use ($record): void {
                                $record->forceFill([
                                    'signature_token' => null,
                                    'signature_token_expires_at' => now(),
                                ])->save();
                                $record->delete();
                            });

                            Notification::make()
                                ->title('Job Carte archivée')
                                ->body($record->signature_status === 'signed'
                                    ? 'Le client a été notifié et l’historique a été conservé.'
                                    : 'L’historique de la Job Carte a été conservé.')
                                ->success()
                                ->send();
                        }),

                    Action::make('envoyer_signature')
                        ->label('Email pour signature')
                        ->color('success')
                        ->icon('heroicon-o-envelope')
                        ->visible(fn ($record): bool => ! $record->trashed())
                        ->requiresConfirmation()
                        ->modalHeading("Confirmation d'envoi email pour signature")
                        ->modalDescription(fn ($record) => "Êtes-vous sûr de vouloir d'envoyer ce mail à {$record->client->nom} ?")
                        ->action(function ($record) {

                            try {

                                $client = $record->client;

                                if (! $client) {
                                    throw new \Exception('Aucun client associé à ce Job Carte.');
                                }

                                if (! $client->email) {
                                    throw new \Exception(
                                        'Le client '.$client->nom.' ne possède pas d’adresse email.'
                                    );
                                }

                                $token = Str::random(64);

                                $record->update([
                                    'signature_token' => $token,
                                    'signature_token_expires_at' => now()->addDays(7),
                                    'signature_status' => 'pending',
                                ]);

                                $link = route('job-carte.signature', [
                                    'token' => $token,
                                ]);

                                Mail::to($client->email)
                                    ->send(new JobCarteSignatureMail(
                                        $record,
                                        $link
                                    ));

                                Notification::make()
                                    ->title('Email envoyé')
                                    ->body('La demande de signature a été envoyée avec succès à '.$client->email)
                                    ->success()
                                    ->send();

                            } catch (\Exception $e) {

                                Notification::make()
                                    ->title('Erreur')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();

                            }
                        }),
                ]),
            ]);
    }
}

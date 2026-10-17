<?php

namespace App\Filament\Resources\JobCartes\Tables;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\JobCarteResource\Pages;
use App\Mail\JobCarteSignatureMail;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
                TextColumn::make('site.asset.Description')
                    ->label('Description')
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
                TextColumn::make('client.nom')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('site.nom')
                    ->label('Site d\'intervention')
                    ->searchable()
                    ->sortable(),
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
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),

                    Action::make('afficher')
                        ->label('Afficher')
                        ->icon('heroicon-o-eye')
                        ->color('primary')
                        ->url(fn ($record) => JobCarteResource::getUrl('fiche', [
                            'record' => $record,
                        ])),

                    Action::make('pdf')
                        ->label('PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('primary')
                        ->url(fn ($record) => route('job-cartes.pdf', $record))
                        ->openUrlInNewTab(),
                    
                    Action::make('envoyer_signature')
                        ->label('Email pour signature')
                        ->color('primary')
                        ->icon('heroicon-o-envelope')
                        ->requiresConfirmation()
                        ->modalHeading("Confirmation d'envoi email pour signature")
                        ->modalDescription(fn ($record) => "Êtes-vous sûr de vouloir d'envoyer ce mail à {$record->client->nom} ?")
                        ->action(function ($record) {

                            try {

                                $client = $record->client;

                                if (!$client) {
                                    throw new \Exception('Aucun client associé à ce Job Carte.');
                                }

                                if (!$client->email) {
                                    throw new \Exception(
                                        'Le client ' . $client->nom . ' ne possède pas d’adresse email.'
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

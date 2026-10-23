<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                /*TextColumn::make('telephone')
                    ->searchable(),*/
                TextColumn::make('display_time_zone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jobCartes')
                    ->label('Nbre Job Cartes')
                    ->counts('jobCartes')
                    ->state(fn ($record): int => (int) $record->job_cartes_count)
                    ->sortable(query: fn (Builder $query, string $direction) => $query
                        ->withCount('jobCartes')
                        ->orderBy('job_cartes_count', $direction)),
                TextColumn::make('jobCartes_2')
                    ->label('Signées')
                    ->getStateUsing(fn ($record) => $record->jobCartes()
                        ->where('signature_status', 'signed')
                        ->count())
                    ->sortable(query: fn (Builder $query, string $direction) => $query
                        ->withCount([
                            'jobCartes as signed_job_cartes_count' => fn (Builder $jobCartes) => $jobCartes
                                ->where('signature_status', 'signed'),
                        ])
                        ->orderBy('signed_job_cartes_count', $direction)),
                TextColumn::make('jobCartes_3')
                    ->label('Non signées')
                    ->getStateUsing(fn ($record) => $record->jobCartes()
                        ->where(fn (Builder $jobCartes) => $jobCartes
                            ->where('signature_status', '!=', 'signed')
                            ->orWhereNull('signature_status'))
                        ->count())
                    ->sortable(query: fn (Builder $query, string $direction) => $query
                        ->withCount([
                            'jobCartes as unsigned_job_cartes_count' => fn (Builder $jobCartes) => $jobCartes
                                ->where(fn (Builder $jobCartes) => $jobCartes
                                    ->where('signature_status', '!=', 'signed')
                                    ->orWhereNull('signature_status')),
                        ])
                        ->orderBy('unsigned_job_cartes_count', $direction)),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}

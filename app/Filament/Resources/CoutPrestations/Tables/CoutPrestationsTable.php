<?php

namespace App\Filament\Resources\CoutPrestations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CoutPrestationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('distance_parcourue_km')
                    ->searchable(),
                TextColumn::make('materiel')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('main_oeuvre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tps_attente')
                    ->searchable(),
                TextColumn::make('deplacement')
                    ->searchable(),
                TextColumn::make('job_carte_id')
                    ->numeric()
                    ->sortable(),
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
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Vehicules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VehiculesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('imsi_sim')
                    ->searchable(),
                TextColumn::make('type_boitier')
                    ->searchable(),
                TextColumn::make('num_data')
                    ->searchable(),
                TextColumn::make('numero_flote')
                    ->searchable(),
                TextColumn::make('marque')
                    ->searchable(),
                TextColumn::make('num_immobilisation')
                    ->searchable(),
                TextColumn::make('nom_ref')
                    ->searchable(),
                TextColumn::make('num_ref')
                    ->searchable(),
                TextColumn::make('num_voix')
                    ->searchable(),
                TextColumn::make('num_serie')
                    ->searchable(),
                TextColumn::make('num_flotte')
                    ->searchable(),
                TextColumn::make('date_mise_en_disposition')
                    ->date()
                    ->sortable(),
                TextColumn::make('heure_mise_en_disposition')
                    ->time()
                    ->sortable(),
                TextColumn::make('nouv_num_appel')
                    ->searchable(),
                TextColumn::make('pin')
                    ->searchable(),
                TextColumn::make('num_chassis')
                    ->searchable(),
                TextColumn::make('immatriculation')
                    ->searchable(),
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

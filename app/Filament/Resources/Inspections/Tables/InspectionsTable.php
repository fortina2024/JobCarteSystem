<?php

namespace App\Filament\Resources\Inspections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InspectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peinture_etat_ext')
                    ->searchable(),
                TextColumn::make('panneaux_inter')
                    ->searchable(),
                TextColumn::make('demarrage_vehicule')
                    ->searchable(),
                TextColumn::make('instruments')
                    ->searchable(),
                TextColumn::make('radio')
                    ->searchable(),
                TextColumn::make('affichage_code_defaut_tab')
                    ->searchable(),
                TextColumn::make('eclairage_ext')
                    ->searchable(),
                TextColumn::make('feux')
                    ->searchable(),
                TextColumn::make('detresse')
                    ->searchable(),
                TextColumn::make('autre_commentaire')
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

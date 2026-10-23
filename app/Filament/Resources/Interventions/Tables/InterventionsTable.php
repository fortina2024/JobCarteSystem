<?php

namespace App\Filament\Resources\Interventions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InterventionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_carte_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type_service_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('version_dors_chargee')
                    ->searchable(),
                IconColumn::make('gprs_gsm_verifie')
                    ->boolean(),
                IconColumn::make('arret_vehicule_verifie')
                    ->boolean(),
                IconColumn::make('fm_terminal_verifie')
                    ->boolean(),
                IconColumn::make('voice_kif_verifie')
                    ->boolean(),
                IconColumn::make('rf_reader_verifie')
                    ->boolean(),
                IconColumn::make('proximite_verifie')
                    ->boolean(),
                TextColumn::make('temps_debut_intervention')
                    ->searchable(),
                TextColumn::make('temps_fin_intervention')
                    ->searchable(),
                TextColumn::make('duree_test_arret_vehicule_verifie')
                    ->searchable(),
                TextColumn::make('distance_arret_vehicule_verifie')
                    ->searchable(),
                TextColumn::make('vitesse_max_fm_terminal_verifie')
                    ->searchable(),
                TextColumn::make('rpm_max_fm_terminal_verifie')
                    ->searchable(),
                TextColumn::make('odo_hrs_moteur_fixe')
                    ->searchable(),
                TextColumn::make('plage_bande_verte_de')
                    ->searchable(),
                TextColumn::make('plage_bande_verte_a')
                    ->searchable(),
                TextColumn::make('sur_regime')
                    ->searchable(),
                IconColumn::make('calibration_vitesse')
                    ->boolean(),
                IconColumn::make('par_distance_fixe')
                    ->boolean(),
                IconColumn::make('par_tableau')
                    ->boolean(),
                IconColumn::make('vitesse_gps')
                    ->boolean(),
                IconColumn::make('can')
                    ->boolean(),
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

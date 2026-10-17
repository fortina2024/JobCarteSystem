<?php

namespace App\Filament\Resources\Interventions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InterventionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('job_carte_id')
                    ->required()
                    ->numeric(),
                TextInput::make('type_service_id')
                    ->required()
                    ->numeric(),
                TextInput::make('version_dors_chargee')
                    ->default(null),
                Toggle::make('gprs_gsm_verifie')
                    ->required(),
                Toggle::make('arret_vehicule_verifie')
                    ->required(),
                Toggle::make('fm_terminal_verifie')
                    ->required(),
                Toggle::make('voice_kif_verifie')
                    ->required(),
                Toggle::make('rf_reader_verifie')
                    ->required(),
                Toggle::make('proximite_verifie')
                    ->required(),
                TextInput::make('temps_debut_gprs_gsm_verifie')
                    ->default(null),
                TextInput::make('temps_fin_gprs_gsm_verifie')
                    ->default(null),
                TextInput::make('duree_test_arret_vehicule_verifie')
                    ->default(null),
                TextInput::make('distance_arret_vehicule_verifie')
                    ->default(null),
                TextInput::make('vitesse_max_fm_terminal_verifie')
                    ->default(null),
                TextInput::make('rpm_max_fm_terminal_verifie')
                    ->default(null),
                TextInput::make('odo_hrs_moteur_fixe')
                    ->default(null),
                TextInput::make('plage_bande_verte_de')
                    ->default(null),
                TextInput::make('plage_bande_verte_a')
                    ->default(null),
                TextInput::make('sur_regime')
                    ->default(null),
                Toggle::make('calibration_vitesse')
                    ->required(),
                Toggle::make('par_distance_fixe')
                    ->required(),
                Toggle::make('par_tableau')
                    ->required(),
                Toggle::make('vitesse_gps')
                    ->required(),
                Toggle::make('can')
                    ->required(),
                Textarea::make('observation')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

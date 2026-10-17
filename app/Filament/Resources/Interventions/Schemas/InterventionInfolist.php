<?php

namespace App\Filament\Resources\Interventions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InterventionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('job_carte_id')
                    ->numeric(),
                TextEntry::make('type_service_id')
                    ->numeric(),
                TextEntry::make('version_dors_chargee')
                    ->placeholder('-'),
                IconEntry::make('gprs_gsm_verifie')
                    ->boolean(),
                IconEntry::make('arret_vehicule_verifie')
                    ->boolean(),
                IconEntry::make('fm_terminal_verifie')
                    ->boolean(),
                IconEntry::make('voice_kif_verifie')
                    ->boolean(),
                IconEntry::make('rf_reader_verifie')
                    ->boolean(),
                IconEntry::make('proximite_verifie')
                    ->boolean(),
                TextEntry::make('temps_debut_gprs_gsm_verifie')
                    ->placeholder('-'),
                TextEntry::make('temps_fin_gprs_gsm_verifie')
                    ->placeholder('-'),
                TextEntry::make('duree_test_arret_vehicule_verifie')
                    ->placeholder('-'),
                TextEntry::make('distance_arret_vehicule_verifie')
                    ->placeholder('-'),
                TextEntry::make('vitesse_max_fm_terminal_verifie')
                    ->placeholder('-'),
                TextEntry::make('rpm_max_fm_terminal_verifie')
                    ->placeholder('-'),
                TextEntry::make('odo_hrs_moteur_fixe')
                    ->placeholder('-'),
                TextEntry::make('plage_bande_verte_de')
                    ->placeholder('-'),
                TextEntry::make('plage_bande_verte_a')
                    ->placeholder('-'),
                TextEntry::make('sur_regime')
                    ->placeholder('-'),
                IconEntry::make('calibration_vitesse')
                    ->boolean(),
                IconEntry::make('par_distance_fixe')
                    ->boolean(),
                IconEntry::make('par_tableau')
                    ->boolean(),
                IconEntry::make('vitesse_gps')
                    ->boolean(),
                IconEntry::make('can')
                    ->boolean(),
                TextEntry::make('observation')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

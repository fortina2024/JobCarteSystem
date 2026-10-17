<?php

namespace App\Filament\Resources\CoutPrestations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CoutPrestationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('distance_parcourue_km')
                    ->default(null),
                TextInput::make('materiel')
                    ->numeric()
                    ->default(null),
                TextInput::make('main_oeuvre')
                    ->numeric()
                    ->default(null),
                TextInput::make('tps_attente')
                    ->default(null),
                TextInput::make('deplacement')
                    ->default(null),
                TextInput::make('job_carte_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}

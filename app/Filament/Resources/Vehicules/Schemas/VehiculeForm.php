<?php

namespace App\Filament\Resources\Vehicules\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class VehiculeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                TextInput::make('imsi_sim')
                    ->default(null),
                TextInput::make('type_boitier')
                    ->default(null),
                TextInput::make('num_data')
                    ->default(null),
                TextInput::make('numero_flote')
                    ->default(null),
                TextInput::make('marque')
                    ->default(null),
                TextInput::make('num_immobilisation')
                    ->default(null),
                TextInput::make('nom_ref')
                    ->default(null),
                TextInput::make('num_ref')
                    ->default(null),
                TextInput::make('num_voix')
                    ->default(null),
                TextInput::make('num_serie')
                    ->default(null),
                TextInput::make('num_flotte')
                    ->default(null),
                DatePicker::make('date_mise_en_disposition'),
                TimePicker::make('heure_mise_en_disposition'),
                TextInput::make('nouv_num_appel')
                    ->default(null),
                TextInput::make('pin')
                    ->default(null),
                TextInput::make('num_chassis')
                    ->default(null),
                TextInput::make('immatriculation')
                    ->default(null),
            ]);
    }
}

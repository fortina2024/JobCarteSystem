<?php

namespace App\Filament\Resources\Inspections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InspectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('peinture_etat_ext')
                    ->default(null),
                TextInput::make('panneaux_inter')
                    ->default(null),
                TextInput::make('demarrage_vehicule')
                    ->default(null),
                TextInput::make('instruments')
                    ->default(null),
                TextInput::make('radio')
                    ->default(null),
                TextInput::make('affichage_code_defaut_tab')
                    ->default(null),
                TextInput::make('eclairage_ext')
                    ->default(null),
                TextInput::make('feux')
                    ->default(null),
                TextInput::make('detresse')
                    ->default(null),
                TextInput::make('autre_commentaire')
                    ->default(null),
                TextInput::make('job_carte_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}

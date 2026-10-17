<?php

namespace App\Filament\Resources\TempsSupplementaires\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TempsSupplementaireForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('debut_heure_suppl'),
                DateTimePicker::make('fin_heure_suppl'),
                DateTimePicker::make('temps_attente_pour'),
                DateTimePicker::make('debut_attente'),
                DateTimePicker::make('fin_attente'),
                TextInput::make('job_carte_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}

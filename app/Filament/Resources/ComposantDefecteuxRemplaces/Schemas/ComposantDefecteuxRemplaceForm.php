<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ComposantDefecteuxRemplaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->default(null),
                TextInput::make('ancien_num_serie')
                    ->default(null),
                TextInput::make('nouveau_num_serie')
                    ->default(null),
                TextInput::make('job_carte_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}

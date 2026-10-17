<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ComposantDefecteuxRemplaceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom')
                    ->placeholder('-'),
                TextEntry::make('ancien_num_serie')
                    ->placeholder('-'),
                TextEntry::make('nouveau_num_serie')
                    ->placeholder('-'),
                TextEntry::make('job_carte_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

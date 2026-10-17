<?php

namespace App\Filament\Resources\CoutPrestations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CoutPrestationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('distance_parcourue_km')
                    ->placeholder('-'),
                TextEntry::make('materiel')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('main_oeuvre')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('tps_attente')
                    ->placeholder('-'),
                TextEntry::make('deplacement')
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

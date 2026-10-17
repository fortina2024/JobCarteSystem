<?php

namespace App\Filament\Resources\TempsSupplementaires\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TempsSupplementaireInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('debut_heure_suppl')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('fin_heure_suppl')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('temps_attente_pour')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('debut_attente')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('fin_attente')
                    ->dateTime()
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

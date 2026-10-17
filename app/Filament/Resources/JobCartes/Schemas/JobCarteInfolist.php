<?php

namespace App\Filament\Resources\JobCartes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JobCarteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('num_job_carte'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('client_id')
                    ->numeric(),
                TextEntry::make('vehicule_id')
                    ->numeric(),
                TextEntry::make('site_d')
                    ->numeric(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('num_commande')
                    ->placeholder('-'),
                TextEntry::make('signature_client')
                    ->placeholder('-'),
                TextEntry::make('signature_technicien')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

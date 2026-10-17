<?php

namespace App\Filament\Resources\Vehicules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VehiculeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client_id')
                    ->numeric(),
                TextEntry::make('imsi_sim')
                    ->placeholder('-'),
                TextEntry::make('type_boitier')
                    ->placeholder('-'),
                TextEntry::make('num_data')
                    ->placeholder('-'),
                TextEntry::make('numero_flote')
                    ->placeholder('-'),
                TextEntry::make('marque')
                    ->placeholder('-'),
                TextEntry::make('num_immobilisation')
                    ->placeholder('-'),
                TextEntry::make('nom_ref')
                    ->placeholder('-'),
                TextEntry::make('num_ref')
                    ->placeholder('-'),
                TextEntry::make('num_voix')
                    ->placeholder('-'),
                TextEntry::make('num_serie')
                    ->placeholder('-'),
                TextEntry::make('num_flotte')
                    ->placeholder('-'),
                TextEntry::make('date_mise_en_disposition')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('heure_mise_en_disposition')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('nouv_num_appel')
                    ->placeholder('-'),
                TextEntry::make('pin')
                    ->placeholder('-'),
                TextEntry::make('num_chassis')
                    ->placeholder('-'),
                TextEntry::make('immatriculation')
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

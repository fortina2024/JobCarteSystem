<?php

namespace App\Filament\Resources\Inspections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InspectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('peinture_etat_ext')
                    ->placeholder('-'),
                TextEntry::make('panneaux_inter')
                    ->placeholder('-'),
                TextEntry::make('demarrage_vehicule')
                    ->placeholder('-'),
                TextEntry::make('instruments')
                    ->placeholder('-'),
                TextEntry::make('radio')
                    ->placeholder('-'),
                TextEntry::make('affichage_code_defaut_tab')
                    ->placeholder('-'),
                TextEntry::make('eclairage_ext')
                    ->placeholder('-'),
                TextEntry::make('feux')
                    ->placeholder('-'),
                TextEntry::make('detresse')
                    ->placeholder('-'),
                TextEntry::make('autre_commentaire')
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

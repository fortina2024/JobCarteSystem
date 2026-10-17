<?php

namespace App\Filament\Resources\TempsSupplementaires\Pages;

use App\Filament\Resources\TempsSupplementaires\TempsSupplementaireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTempsSupplementaires extends ListRecords
{
    protected static string $resource = TempsSupplementaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

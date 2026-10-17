<?php

namespace App\Filament\Resources\CoutPrestations\Pages;

use App\Filament\Resources\CoutPrestations\CoutPrestationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoutPrestations extends ListRecords
{
    protected static string $resource = CoutPrestationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

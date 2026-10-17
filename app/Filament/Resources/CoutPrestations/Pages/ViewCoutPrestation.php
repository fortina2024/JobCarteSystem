<?php

namespace App\Filament\Resources\CoutPrestations\Pages;

use App\Filament\Resources\CoutPrestations\CoutPrestationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCoutPrestation extends ViewRecord
{
    protected static string $resource = CoutPrestationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

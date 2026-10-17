<?php

namespace App\Filament\Resources\CoutPrestations\Pages;

use App\Filament\Resources\CoutPrestations\CoutPrestationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCoutPrestation extends EditRecord
{
    protected static string $resource = CoutPrestationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Vehicules\Pages;

use App\Filament\Resources\Vehicules\VehiculeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicule extends ViewRecord
{
    protected static string $resource = VehiculeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

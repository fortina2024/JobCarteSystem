<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJobCarte extends ViewRecord
{
    protected static string $resource = JobCarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

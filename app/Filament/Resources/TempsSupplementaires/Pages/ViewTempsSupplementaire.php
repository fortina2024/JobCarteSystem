<?php

namespace App\Filament\Resources\TempsSupplementaires\Pages;

use App\Filament\Resources\TempsSupplementaires\TempsSupplementaireResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTempsSupplementaire extends ViewRecord
{
    protected static string $resource = TempsSupplementaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\TempsSupplementaires\Pages;

use App\Filament\Resources\TempsSupplementaires\TempsSupplementaireResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTempsSupplementaire extends EditRecord
{
    protected static string $resource = TempsSupplementaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

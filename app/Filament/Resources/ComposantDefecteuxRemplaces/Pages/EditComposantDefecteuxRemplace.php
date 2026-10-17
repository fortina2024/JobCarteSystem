<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces\Pages;

use App\Filament\Resources\ComposantDefecteuxRemplaces\ComposantDefecteuxRemplaceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditComposantDefecteuxRemplace extends EditRecord
{
    protected static string $resource = ComposantDefecteuxRemplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces\Pages;

use App\Filament\Resources\ComposantDefecteuxRemplaces\ComposantDefecteuxRemplaceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewComposantDefecteuxRemplace extends ViewRecord
{
    protected static string $resource = ComposantDefecteuxRemplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces\Pages;

use App\Filament\Resources\ComposantDefecteuxRemplaces\ComposantDefecteuxRemplaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComposantDefecteuxRemplaces extends ListRecords
{
    protected static string $resource = ComposantDefecteuxRemplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

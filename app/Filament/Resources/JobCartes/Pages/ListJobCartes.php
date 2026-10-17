<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobCartes extends ListRecords
{
    protected static string $resource = JobCarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

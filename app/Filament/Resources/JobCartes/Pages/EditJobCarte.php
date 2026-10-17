<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJobCarte extends EditRecord
{
    protected static string $resource = JobCarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record->load([
            'vehicule',
            'inspection',
            'intervention',
            'temps_supplementaire',
        ]);

        // Vehicule
        $data = array_merge($data, $record->vehicule?->toArray() ?? []);

        // Inspection
        $data = array_merge($data, $record->inspection?->toArray() ?? []);

        // Intervention
        $data = array_merge($data, $record->intervention?->toArray() ?? []);

        // Infos supplementaire
        $data = array_merge($data, $record->temps_supplementaire?->toArray() ?? []);

        return $data;
    }
}

<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJobCarte extends EditRecord
{
    protected static string $resource = JobCarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
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

        $data['vehicule'] = $record->vehicule?->getAttributes() ?? [];
        $data['inspection'] = $record->inspection?->getAttributes() ?? [];
        $data['intervention'] = $record->intervention?->getAttributes() ?? [];
        $data['temps_supplementaire'] = $record->temps_supplementaire?->getAttributes() ?? [];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $relatedData = [
            'intervention' => 'intervention',
            'temps_supplementaire' => 'temps_supplementaire',
        ];

        foreach ($relatedData as $stateKey => $relationName) {
            $relationData = $data[$stateKey] ?? [];
            unset($data[$stateKey]);

            if ($relationData !== []) {
                $record->{$relationName}()->updateOrCreate([], $relationData);
            }
        }

        $record->update($data);

        return $record;
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->requiresConfirmation()
            ->modalHeading('Confirmer la modification')
            ->modalDescription('Voulez-vous vraiment enregistrer les modifications de cette Job Carte ?')
            ->modalSubmitActionLabel('Oui, modifier')
            ->modalCancelActionLabel('Annuler');
    }
}

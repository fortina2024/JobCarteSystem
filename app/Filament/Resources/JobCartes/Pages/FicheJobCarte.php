<?php
namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class FicheJobCarte extends Page
{
    use InteractsWithRecord;

    protected static string $resource = JobCarteResource::class;

    protected string $view = 'filament.resources.job-cartes.pages.fiche-job-carte';

    public function mount(int|string $record): void
    {
        // On laisse le trait initialiser correctement le record avec son ID
        $this->record = $this->resolveRecord($record);
    }
}
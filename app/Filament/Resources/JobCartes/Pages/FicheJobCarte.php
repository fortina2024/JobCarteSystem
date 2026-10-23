<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class FicheJobCarte extends Page
{
    use InteractsWithRecord;

    protected static string $resource = JobCarteResource::class;

    protected string $view = 'filament.resources.job-cartes.pages.fiche-job-carte';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        if (
            ! $this->record->trashed() &&
            $this->record->signature_status === 'pending' &&
            (
                ! $this->record->signature_token ||
                ! $this->record->signature_token_expires_at ||
                $this->record->signature_token_expires_at->isPast()
            )
        ) {
            $this->record->forceFill([
                'signature_token' => Str::random(64),
                'signature_token_expires_at' => now()->addDays(7),
            ])->save();
        }
    }

    public function getHeading(): string|Htmlable|null
    {
        return null;
    }
}

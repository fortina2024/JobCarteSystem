<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\InteractsWithJobCarteDashboardFilters;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class JobCarteStatsOverview extends StatsOverviewWidget
{
    use InteractsWithJobCarteDashboardFilters;

    protected int|string|array $columnSpan = 'full';

    protected int|array|null $columns = ['default' => 1, 'md' => 2, 'xl' => 6];

    protected function getStats(): array
    {
        $query = $this->filteredJobCartes();
        $total = (clone $query)->count();
        $signed = (clone $query)->where('job_cartes.signature_status', 'signed')->count();
        $unsigned = (clone $query)
            ->where(fn (Builder $query) => $query
                ->where('job_cartes.signature_status', '!=', 'signed')
                ->orWhereNull('job_cartes.signature_status'))
            ->count();
        $vehicles = (clone $query)->whereHas('vehicule')->count();
        $average = $vehicles > 0 ? $total / $vehicles : 0;
        $interventionSeconds = 0;
        $interventionCount = 0;
        $supplementarySeconds = 0;
        $supplementaryCount = 0;

        (clone $query)
            ->select('job_cartes.id')
            ->with(['intervention', 'temps_supplementaire'])
            ->chunk(500, function ($jobCartes) use (&$interventionSeconds, &$interventionCount, &$supplementarySeconds, &$supplementaryCount): void {
                foreach ($jobCartes as $jobCarte) {
                    $interventionDuration = $this->durationInSeconds(
                        $jobCarte->intervention?->temps_debut_intervention,
                        $jobCarte->intervention?->temps_fin_intervention,
                    );

                    if ($interventionDuration !== null) {
                        $interventionSeconds += $interventionDuration;
                        $interventionCount++;
                    }

                    $supplementaryDuration = $this->durationInSeconds(
                        $jobCarte->temps_supplementaire?->debut_heure_suppl,
                        $jobCarte->temps_supplementaire?->fin_heure_suppl,
                    );

                    if ($supplementaryDuration !== null) {
                        $supplementarySeconds += $supplementaryDuration;
                        $supplementaryCount++;
                    }
                }
            });

        return [
            Stat::make('Véh. concernés', number_format($vehicles, 0, ',', ' '))
                ->description('Par filtrage')
                ->color('info'),
            Stat::make('Job cartes signées', number_format($signed, 0, ',', ' '))
                ->description('Statut signé')
                ->color('success'),
            Stat::make('Job c. non signées', number_format($unsigned, 0, ',', ' '))
                ->description('En attente')
                ->color('warning'),
            Stat::make('Moy. Job c./véh.', number_format($average, 2, ',', ' '))
                ->description('Véh. sélectionnés')
                ->color('primary'),
            Stat::make('Moy. Hrs. service', $this->formatAverageDuration($interventionSeconds, $interventionCount))
                ->description('Format (H:mm)')
                ->color('info'),
            Stat::make('Moy. Hrs. suppl.', $this->formatAverageDuration($supplementarySeconds, $supplementaryCount))
                ->description('Format (H:mm)')
                ->color('warning'),
        ];
    }

    private function durationInSeconds(mixed $startValue, mixed $endValue): ?int
    {
        if (blank($startValue) || blank($endValue)) {
            return null;
        }

        $start = Carbon::parse($startValue);
        $end = Carbon::parse($endValue);

        if ($end->lessThan($start)) {
            $end->addDay();
        }

        return $end->getTimestamp() - $start->getTimestamp();
    }

    private function formatAverageDuration(int $totalSeconds, int $count): string
    {
        if ($count === 0) {
            return '-';
        }

        $averageMinutes = (int) round($totalSeconds / $count / 60);

        return sprintf('%02d:%02d', intdiv($averageMinutes, 60), $averageMinutes % 60);
    }
}

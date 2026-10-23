<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\InteractsWithJobCarteDashboardFilters;
use Filament\Widgets\ChartWidget;

class JobCarteClientChart extends ChartWidget
{
    use InteractsWithJobCarteDashboardFilters;

    protected ?string $heading = 'Job cartes enregistrées par client';

    protected int|string|array $columnSpan = 1;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $rows = $this->filteredJobCartes()
            ->join('clients', 'clients.id', '=', 'job_cartes.client_id')
            ->selectRaw('clients.nom AS client_name, COUNT(job_cartes.id) AS total')
            ->groupBy('clients.id', 'clients.nom')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [[
                'label' => 'Job cartes',
                'data' => $rows->pluck('total')->all(),
                'backgroundColor' => '#d97706',
            ]],
            'labels' => $rows->pluck('client_name')->all(),
        ];
    }
}

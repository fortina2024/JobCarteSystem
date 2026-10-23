<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\InteractsWithJobCarteDashboardFilters;
use Filament\Widgets\ChartWidget;

class JobCarteVehiclesChart extends ChartWidget
{
    use InteractsWithJobCarteDashboardFilters;

    protected ?string $heading = 'Job cartes signées et véhicules par client';

    protected ?string $maxHeight = '320px';

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $rows = $this->filteredJobCartes()
            ->join('clients', 'clients.id', '=', 'job_cartes.client_id')
            ->leftJoin('vehicules', 'vehicules.job_carte_id', '=', 'job_cartes.id')
            ->selectRaw('clients.nom AS client_name')
            ->selectRaw("SUM(CASE WHEN job_cartes.signature_status = 'signed' THEN 1 ELSE 0 END) AS signed_total")
            ->selectRaw('COUNT(DISTINCT vehicules.id) AS vehicle_total')
            ->groupBy('clients.id', 'clients.nom')
            ->orderBy('clients.nom')
            ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Job cartes signées',
                    'data' => $rows->pluck('signed_total')->all(),
                    'backgroundColor' => '#15803d',
                ],
                [
                    'label' => 'Véhicules',
                    'data' => $rows->pluck('vehicle_total')->all(),
                    'backgroundColor' => '#0284c7',
                ],
            ],
            'labels' => $rows->pluck('client_name')->all(),
        ];
    }
}

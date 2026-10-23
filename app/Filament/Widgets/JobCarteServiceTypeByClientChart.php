<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\InteractsWithJobCarteDashboardFilters;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class JobCarteServiceTypeByClientChart extends ChartWidget
{
    use InteractsWithJobCarteDashboardFilters;

    protected ?string $heading = 'Répartition des types de service par client';

    protected ?string $description = 'Pourcentage de chaque type parmi les services renseignés';

    protected ?string $maxHeight = '420px';

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array | RawJs | null
    {
        return RawJs::make(<<<'JS'
({
            indexAxis: 'y',
            scales: {
                x: {
                    stacked: true,
                    min: 0,
                    max: 100,
                    ticks: {
                        stepSize: 20,
                    },
                },
                y: {
                    stacked: true,
                },
            },
            plugins: {
                legend: { position: 'bottom' },
                datalabels: {
                    anchor: 'center',
                    align: 'center',
                    color: '#ffffff',
                    display: 'auto',
                    formatter: (value) => value > 0 ? `${value}%` : '',
                },
            },
})
JS);
    }

    protected function getData(): array
    {
        $rows = $this->filteredJobCartes(true, false)
            ->join('clients', 'clients.id', '=', 'job_cartes.client_id')
            ->leftJoin('interventions', 'interventions.job_carte_id', '=', 'job_cartes.id')
            ->selectRaw('clients.nom AS client_name')
            ->selectRaw('SUM(CASE WHEN interventions.nouv_installation = 1 THEN 1 ELSE 0 END) AS installation_total')
            ->selectRaw('SUM(CASE WHEN interventions.reinstallation = 1 THEN 1 ELSE 0 END) AS reinstallation_total')
            ->selectRaw('SUM(CASE WHEN interventions.maintenance = 1 THEN 1 ELSE 0 END) AS maintenance_total')
            ->selectRaw('SUM(CASE WHEN interventions.panne = 1 THEN 1 ELSE 0 END) AS panne_total')
            ->selectRaw('SUM(CASE WHEN interventions.desinstallation = 1 THEN 1 ELSE 0 END) AS desinstallation_total')
            ->groupBy('clients.id', 'clients.nom')
            ->orderBy('clients.nom')
            ->get();

        $serviceColumns = [
            'Nouvelle installation' => 'installation_total',
            'Réinstallation' => 'reinstallation_total',
            'Maintenance' => 'maintenance_total',
            'Panne' => 'panne_total',
            'Désinstallation' => 'desinstallation_total',
        ];
        $columns = array_values($serviceColumns);
        $rows = $rows->filter(fn ($row): bool => array_sum(array_map(
            fn (string $column): int => (int) $row->{$column},
            $columns,
        )) > 0)->values();

        $datasets = [];
        $colors = ['#0284c7', '#7c3aed', '#d97706', '#dc2626', '#15803d'];

        foreach ($columns as $index => $column) {
            $datasets[] = [
                'label' => array_keys($serviceColumns)[$index],
                'data' => $rows->map(function ($row) use ($columns, $column): float {
                    $total = array_sum(array_map(
                        fn (string $serviceColumn): int => (int) $row->{$serviceColumn},
                        $columns,
                    ));

                    return $total > 0 ? round(((int) $row->{$column} / $total) * 100, 1) : 0;
                })->all(),
                'backgroundColor' => $colors[$index],
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $rows->pluck('client_name')->all(),
        ];
    }
}

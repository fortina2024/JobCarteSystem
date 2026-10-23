<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\InteractsWithJobCarteDashboardFilters;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class JobCarteStatusTrendChart extends ChartWidget
{
    use InteractsWithJobCarteDashboardFilters;

    protected ?string $heading = 'Tendance des Job cartes signées et non signées';

    protected int|string|array $columnSpan = 1;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        [$start, $end] = $this->dashboardDateRange();
        $rows = $this->filteredJobCartes()
            ->selectRaw('DATE(job_cartes.created_at) AS day')
            ->selectRaw("SUM(CASE WHEN job_cartes.signature_status = 'signed' THEN 1 ELSE 0 END) AS signed_total")
            ->selectRaw("SUM(CASE WHEN job_cartes.signature_status = 'signed' THEN 0 ELSE 1 END) AS unsigned_total")
            ->groupBy('day')
            ->get()
            ->keyBy('day');

        $labels = [];
        $signed = [];
        $unsigned = [];

        foreach (CarbonPeriod::create($start->copy()->startOfDay(), '1 day', $end->copy()->startOfDay()) as $date) {
            $key = $date->toDateString();
            $row = $rows->get($key);
            $labels[] = $date->format('d/m');
            $signed[] = (int) ($row?->signed_total ?? 0);
            $unsigned[] = (int) ($row?->unsigned_total ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Signées',
                    'data' => $signed,
                    'borderColor' => '#15803d',
                    'backgroundColor' => '#15803d',
                    'tension' => 0.25,
                ],
                [
                    'label' => 'Non signées',
                    'data' => $unsigned,
                    'borderColor' => '#d97706',
                    'backgroundColor' => '#d97706',
                    'tension' => 0.25,
                ],
            ],
            'labels' => $labels,
        ];
    }
}

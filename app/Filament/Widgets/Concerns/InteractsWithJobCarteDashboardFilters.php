<?php

namespace App\Filament\Widgets\Concerns;

use App\Models\JobCarte;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

trait InteractsWithJobCarteDashboardFilters
{
    public array $filters = [];

    #[On('job-carte-dashboard-filters-updated')]
    public function updateDashboardFilters(array $filters): void
    {
        $this->filters = $filters;

        if (property_exists($this, 'cachedData')) {
            $this->cachedData = null;
        }

        if (property_exists($this, 'cachedStats')) {
            $this->cachedStats = null;
        }
    }

    protected function dashboardDateRange(): array
    {
        $now = now();

        return match ($this->filters['period'] ?? 'last_30_days') {
            'today' => [$now->copy()->startOfDay(), $now],
            'yesterday' => [$now->copy()->subDay()->startOfDay(), $now->copy()->subDay()->endOfDay()],
            'last_7_days' => [$now->copy()->subDays(6)->startOfDay(), $now],
            'this_month' => [$now->copy()->startOfMonth(), $now],
            'this_year' => [$now->copy()->startOfYear(), $now],
            'custom' => $this->customDateRange(),
            default => [$now->copy()->subDays(29)->startOfDay(), $now],
        };
    }

    protected function customDateRange(): array
    {
        try {
            $start = filled($this->filters['start_date'] ?? null)
                ? Carbon::parse($this->filters['start_date'])->startOfDay()
                : now()->subDays(29)->startOfDay();
            $end = filled($this->filters['end_date'] ?? null)
                ? Carbon::parse($this->filters['end_date'])->endOfDay()
                : now()->endOfDay();
        } catch (\Throwable) {
            return [now()->subDays(29)->startOfDay(), now()->endOfDay()];
        }

        return $start->greaterThan($end)
            ? [$end->copy()->startOfDay(), $start->copy()->endOfDay()]
            : [$start, $end];
    }

    protected function filteredJobCartes(bool $applyStatus = true, bool $applyServiceType = true): Builder
    {
        [$start, $end] = $this->dashboardDateRange();

        $query = JobCarte::query()->whereBetween('job_cartes.created_at', [$start, $end]);

        if (is_numeric($this->filters['client_id'] ?? null)) {
            $query->where('job_cartes.client_id', $this->filters['client_id']);
        }

        if (is_numeric($this->filters['site_id'] ?? null)) {
            $query->where('job_cartes.site_id', $this->filters['site_id']);
        }

        if (is_numeric($this->filters['user_id'] ?? null)) {
            $query->where('job_cartes.user_id', $this->filters['user_id']);
        }

        $serviceColumn = match ($this->filters['service_type'] ?? null) {
            'nouv_installation', 'reinstallation', 'maintenance', 'panne', 'desinstallation' => $this->filters['service_type'],
            default => null,
        };

        if ($applyServiceType && $serviceColumn !== null) {
            $query->whereHas('intervention', fn (Builder $interventionQuery) => $interventionQuery
                ->where($serviceColumn, true));
        }

        if ($applyStatus) {
            match ($this->filters['status'] ?? 'all') {
                'signed' => $query->where('job_cartes.signature_status', 'signed'),
                'unsigned' => $query->where(fn (Builder $query) => $query
                    ->where('job_cartes.signature_status', '!=', 'signed')
                    ->orWhereNull('job_cartes.signature_status')),
                default => null,
            };
        }

        return $query;
    }
}

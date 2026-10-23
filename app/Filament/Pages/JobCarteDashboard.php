<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\JobCarteClientChart;
use App\Filament\Widgets\JobCarteServiceTypeByClientChart;
use App\Filament\Widgets\JobCarteStatsOverview;
use App\Filament\Widgets\JobCarteStatusTrendChart;
use App\Filament\Widgets\JobCarteVehiclesChart;
use App\Models\Client;
use App\Models\Site;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class JobCarteDashboard extends Dashboard
{
    protected static ?string $title = 'Dashboard';

    public array $filters = [];

    public function mount(): void
    {
        $this->filters = [
            'period' => 'last_7_days',
            'client_id' => null,
            'site_id' => null,
            'user_id' => null,
            'service_type' => null,
            'status' => 'all',
            'start_date' => now()->subDays(6)->toDateString(),
            'end_date' => now()->toDateString(),
        ];
    }

    public function updatedFilters(mixed $value = null, ?string $key = null): void
    {
        $this->dispatch('job-carte-dashboard-filters-updated', filters: $this->filters);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            EmbeddedSchema::make('dashboardFiltersForm'),
            $this->getWidgetsContentComponent()
                ->extraAttributes(['style' => 'margin-top: -0.75rem']),
        ]);
    }

    public function dashboardFiltersForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('filters')
            ->components([
                Grid::make(['default' => 1, 'md' => 2, 'xl' => 6])
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Select::make('period')
                                    ->label('Période')
                                    ->hintIcon('heroicon-m-calendar-days', 'Choisir la période des données')
                                    ->options([
                                        'today' => 'Aujourd’hui',
                                        'yesterday' => 'Hier',
                                        'last_7_days' => '7 derniers jours',
                                        'last_30_days' => '30 derniers jours',
                                        'this_month' => 'Ce mois',
                                        'this_year' => 'Cette année',
                                        'custom' => 'Période personnalisée',
                                    ])
                                    ->live(),
                                Grid::make(2)
                                    ->schema([
                                        DatePicker::make('start_date')
                                            ->label('Du')
                                            ->hintIcon('heroicon-m-calendar', 'Date de début de la période personnalisée')
                                            ->visible(fn (Get $get): bool => $get('period') === 'custom')
                                            ->live(),
                                        DatePicker::make('end_date')
                                            ->label('Au')
                                            ->hintIcon('heroicon-m-calendar', 'Date de fin de la période personnalisée')
                                            ->visible(fn (Get $get): bool => $get('period') === 'custom')
                                            ->live(),
                                    ]),
                            ]),
                        Select::make('client_id')
                            ->label('Client')
                            ->hintIcon('heroicon-m-building-office-2', 'Filtrer par client')
                            ->placeholder('Tous les clients')
                            ->options(fn (): array => Client::query()
                                ->orderBy('nom')
                                ->pluck('nom', 'id')
                                ->all())
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('site_id', null)),
                        Select::make('site_id')
                            ->label('Site')
                            ->hintIcon('heroicon-m-map-pin', 'Filtrer par site du client sélectionné')
                            ->placeholder('Tous les sites')
                            ->options(fn (Get $get): array => Site::query()
                                ->when($get('client_id'), fn (Builder $query, $clientId) => $query->where('client_id', $clientId))
                                ->orderBy('nom')
                                ->pluck('nom', 'id')
                                ->all())
                            ->disabled(fn (Get $get): bool => blank($get('client_id')))
                            ->live(),
                        Select::make('user_id')
                            ->label('Technicien')
                            ->hintIcon('heroicon-m-user', 'Filtrer par technicien')
                            ->placeholder('Tous les techniciens')
                            ->options(fn (): array => User::query()
                                ->whereHas('job_cartes')
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->all())
                            ->searchable()
                            ->live(),
                        Select::make('service_type')
                            ->label('Type de service')
                            ->hintIcon('heroicon-m-wrench-screwdriver', 'Filtrer par type d’intervention')
                            ->placeholder('Tous les services')
                            ->options([
                                'nouv_installation' => 'Nouvelle installation',
                                'reinstallation' => 'Réinstallation',
                                'maintenance' => 'Maintenance',
                                'panne' => 'Panne',
                                'desinstallation' => 'Désinstallation',
                            ])
                            ->live(),
                        Select::make('status')
                            ->label('État de signature')
                            ->hintIcon('heroicon-m-pencil-square', 'Filtrer selon l’état de signature')
                            ->options([
                                'all' => 'Signées et non signées',
                                'signed' => 'Signées',
                                'unsigned' => 'Non signées',
                            ])
                            ->live(),
                    ]),
            ]);
    }

    public function getWidgets(): array
    {
        return [
            JobCarteStatsOverview::make(['filters' => $this->filters]),
            JobCarteClientChart::make(['filters' => $this->filters]),
            JobCarteStatusTrendChart::make(['filters' => $this->filters]),
            JobCarteServiceTypeByClientChart::make(['filters' => $this->filters]),
            JobCarteVehiclesChart::make(['filters' => $this->filters]),
        ];
    }

    public function getColumns(): int|array
    {
        return ['default' => 1, 'xl' => 2];
    }
}

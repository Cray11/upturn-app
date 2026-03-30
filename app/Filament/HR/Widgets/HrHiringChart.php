<?php

namespace App\Filament\HR\Widgets;

use App\Models\Application;
use App\Models\JobPosting;
use Filament\Widgets\ChartWidget;

class HrHiringChart extends ChartWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Hiring Activity';

    protected static ?string $description = 'Monthly trends for applications, open roles, and hired candidates.';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    protected function getData(): array
    {
        $months = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => now()->startOfMonth()->subMonths($monthsAgo));

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $months->map(fn ($month) => Application::query()->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
                    'borderColor' => '#0f766e',
                    'backgroundColor' => 'rgba(15, 118, 110, 0.12)',
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Open Roles',
                    'data' => $months->map(fn ($month) => JobPosting::query()->where('status', 'open')->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
                    'borderColor' => '#1d4ed8',
                    'backgroundColor' => 'rgba(29, 78, 216, 0.12)',
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Hired Candidates',
                    'data' => $months->map(fn ($month) => Application::query()->where('status', 'hired')->whereBetween('updated_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
                    'borderColor' => '#16a34a',
                    'backgroundColor' => 'rgba(22, 163, 74, 0.12)',
                    'tension' => 0.35,
                ],
            ],
            'labels' => $months->map(fn ($month) => $month->format('M Y'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

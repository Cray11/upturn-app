<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Post;
use Filament\Widgets\ChartWidget;

class AdminActivityChart extends ChartWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Platform Activity';

    protected static ?string $description = 'Monthly trends for leads, bookings, and published content.';

    protected function getData(): array
    {
        $months = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => now()->startOfMonth()->subMonths($monthsAgo));

        return [
            'datasets' => [
                [
                    'label' => 'Inquiries',
                    'data' => $months->map(fn ($month) => Inquiry::query()->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.12)',
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Bookings',
                    'data' => $months->map(fn ($month) => Booking::query()->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.12)',
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Published Posts',
                    'data' => $months->map(fn ($month) => Post::published()->whereBetween('published_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count())->all(),
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

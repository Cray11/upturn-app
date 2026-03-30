<?php

namespace App\Filament\HR\Widgets;

use App\Filament\HR\Resources\ApplicationResource;
use App\Filament\HR\Resources\JobPostingResource;
use App\Models\Application;
use App\Models\JobPosting;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HrStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Open Roles', number_format(JobPosting::open()->count()))
                ->description(number_format(JobPosting::query()->count()).' total job postings')
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart($this->dailyTrend(fn ($start, $end) => JobPosting::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('primary')
                ->url(JobPostingResource::getUrl('index')),

            Stat::make('New Applications', number_format(Application::query()->where('status', 'new')->count()))
                ->description(number_format(Application::query()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()).' submitted this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->dailyTrend(fn ($start, $end) => Application::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('warning')
                ->url(ApplicationResource::getUrl('index')),

            Stat::make('Interviews In Progress', number_format(Application::query()->whereIn('status', ['screening', 'interview'])->count()))
                ->description(number_format(Application::query()->where('status', 'offer')->count()).' currently at offer stage')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($this->dailyTrend(fn ($start, $end) => Application::query()->whereIn('status', ['screening', 'interview'])->whereBetween('updated_at', [$start, $end])->count()))
                ->color('info')
                ->url(ApplicationResource::getUrl('index')),

            Stat::make('Hired This Month', number_format(Application::query()->where('status', 'hired')->whereBetween('updated_at', [now()->startOfMonth(), now()->endOfMonth()])->count()))
                ->description(number_format(Application::query()->where('status', 'hired')->count()).' total hired candidates')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart($this->dailyTrend(fn ($start, $end) => Application::query()->where('status', 'hired')->whereBetween('updated_at', [$start, $end])->count()))
                ->color('success')
                ->url(ApplicationResource::getUrl('index')),
        ];
    }

    private function dailyTrend(callable $callback): array
    {
        return collect(range(6, 0))
            ->map(function (int $daysAgo) use ($callback): int {
                $start = now()->subDays($daysAgo)->startOfDay();
                $end = now()->subDays($daysAgo)->endOfDay();

                return (int) $callback($start, $end);
            })
            ->all();
    }
}

<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\BookingResource;
use App\Filament\Admin\Resources\InquiryResource;
use App\Filament\Admin\Resources\PostResource;
use App\Filament\Admin\Resources\ServiceResource;
use App\Filament\Admin\Resources\SpaceResource;
use App\Filament\Admin\Resources\UserResource;
use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Service;
use App\Models\Space;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'staff']) ?? false;
    }

    protected function getStats(): array
    {
        $stats = [
            Stat::make('New Inquiries', number_format(Inquiry::query()->where('status', 'new')->count()))
                ->description(number_format(Inquiry::query()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()).' received this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->dailyTrend(fn ($start, $end) => Inquiry::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('warning')
                ->url(InquiryResource::getUrl('index')),

            Stat::make('Pending Bookings', number_format(Booking::query()->where('status', 'pending')->count()))
                ->description(number_format(Booking::query()->whereDate('booking_date', '>=', today())->count()).' upcoming bookings')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->chart($this->dailyTrend(fn ($start, $end) => Booking::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('primary')
                ->url(BookingResource::getUrl('index')),

            Stat::make('Published Posts', number_format(Post::published()->count()))
                ->description(number_format(Post::published()->whereBetween('published_at', [now()->startOfMonth(), now()->endOfMonth()])->count()).' published this month')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart($this->dailyTrend(fn ($start, $end) => Post::published()->whereBetween('published_at', [$start, $end])->count()))
                ->color('success')
                ->url(PostResource::getUrl('index')),

            Stat::make('Active Services', number_format(Service::active()->count()))
                ->description(number_format(Service::query()->count()).' total service records')
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart($this->dailyTrend(fn ($start, $end) => Service::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('info')
                ->url(ServiceResource::getUrl('index')),

            Stat::make('Available Spaces', number_format(Space::available()->count()))
                ->description(number_format(Space::query()->count()).' total workspace listings')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->chart($this->dailyTrend(fn ($start, $end) => Space::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('gray')
                ->url(SpaceResource::getUrl('index')),
        ];

        if (auth()->user()?->hasPortalRole(['admin'])) {
            $stats[] = Stat::make('Active Team Members', number_format(User::query()->where('is_active', true)->count()))
                ->description(number_format(User::query()->where('is_active', false)->count()).' currently inactive')
                ->descriptionIcon('heroicon-m-users')
                ->chart($this->dailyTrend(fn ($start, $end) => User::query()->whereBetween('created_at', [$start, $end])->count()))
                ->color('primary')
                ->url(UserResource::getUrl('index'));
        }

        return $stats;
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

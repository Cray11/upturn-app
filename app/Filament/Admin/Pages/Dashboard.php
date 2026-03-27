<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\AdminActivityChart;
use App\Filament\Admin\Widgets\AdminQuickActions;
use App\Filament\Admin\Widgets\AdminStatsOverview;
use App\Filament\Admin\Widgets\RecentInquiriesTable;
use App\Filament\Admin\Widgets\UpcomingBookingsTable;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $title = 'Admin Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AdminStatsOverview::class,
            AdminActivityChart::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AdminQuickActions::class,
            RecentInquiriesTable::class,
            UpcomingBookingsTable::class,
        ];
    }
}

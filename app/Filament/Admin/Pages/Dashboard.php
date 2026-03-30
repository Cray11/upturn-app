<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\AdminActivityChart;
use App\Filament\Admin\Widgets\AdminQuickActions;
use App\Filament\Admin\Widgets\AdminStatsOverview;
use App\Filament\Admin\Widgets\RecentInquiriesTable;
use App\Filament\Admin\Widgets\UpcomingBookingsTable;
use App\Filament\HR\Widgets\HrHiringChart;
use App\Filament\HR\Widgets\HrStatsOverview;
use App\Filament\HR\Widgets\OpenJobPostingsTable;
use App\Filament\HR\Widgets\RecentApplicationsTable;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public function getTitle(): string | Htmlable
    {
        return match ($this->portalRole()) {
            'admin' => 'Admin Dashboard',
            'hr' => 'HR Dashboard',
            default => 'Staff Dashboard',
        };
    }

    protected function getHeaderWidgets(): array
    {
        return match ($this->portalRole()) {
            'hr' => [
                HrStatsOverview::class,
                HrHiringChart::class,
            ],
            default => [
                AdminStatsOverview::class,
                AdminActivityChart::class,
            ],
        };
    }

    protected function getFooterWidgets(): array
    {
        return match ($this->portalRole()) {
            'hr' => [
                RecentApplicationsTable::class,
                OpenJobPostingsTable::class,
            ],
            default => [
                AdminQuickActions::class,
                RecentInquiriesTable::class,
                UpcomingBookingsTable::class,
            ],
        };
    }

    private function portalRole(): string
    {
        $user = auth()->user();

        if ($user?->hasPortalRole(['admin'])) {
            return 'admin';
        }

        if ($user?->hasPortalRole(['hr'])) {
            return 'hr';
        }

        return 'staff';
    }
}

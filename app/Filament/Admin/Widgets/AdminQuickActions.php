<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\BookingResource;
use App\Filament\Admin\Resources\InquiryResource;
use App\Filament\Admin\Resources\PostResource;
use App\Filament\Admin\Resources\ServiceResource;
use App\Filament\Admin\Resources\UserResource;
use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Filament\Widgets\Widget;

class AdminQuickActions extends Widget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.admin.widgets.admin-quick-actions';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'staff']) ?? false;
    }

    protected function getViewData(): array
    {
        $actions = [
            [
                'label' => 'Inquiries',
                'description' => 'Respond to fresh leads and assign them to the right staff member.',
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'count' => Inquiry::query()->unresolved()->count(),
                'count_label' => 'open items',
                'manage_url' => InquiryResource::getUrl('index'),
                'create_url' => InquiryResource::getUrl('create'),
            ],
            [
                'label' => 'Bookings',
                'description' => 'Confirm reservations, review space usage, and handle scheduling conflicts.',
                'icon' => 'heroicon-o-calendar-days',
                'count' => Booking::query()->where('status', 'pending')->count(),
                'count_label' => 'pending',
                'manage_url' => BookingResource::getUrl('index'),
                'create_url' => BookingResource::getUrl('create'),
            ],
            [
                'label' => 'Posts',
                'description' => 'Publish updates and keep the public site fresh with new content.',
                'icon' => 'heroicon-o-document-text',
                'count' => Post::published()->count(),
                'count_label' => 'live posts',
                'manage_url' => PostResource::getUrl('index'),
                'create_url' => PostResource::getUrl('create'),
            ],
            [
                'label' => 'Services',
                'description' => 'Maintain the service catalog that powers the public pages and inquiry forms.',
                'icon' => 'heroicon-o-briefcase',
                'count' => Service::active()->count(),
                'count_label' => 'active services',
                'manage_url' => ServiceResource::getUrl('index'),
                'create_url' => ServiceResource::getUrl('create'),
            ],
        ];

        if (auth()->user()?->hasPortalRole(['admin'])) {
            $actions[] = [
                'label' => 'Users',
                'description' => 'Manage access for admins, HR, and staff working inside the control panel.',
                'icon' => 'heroicon-o-users',
                'count' => User::query()->where('is_active', true)->count(),
                'count_label' => 'active users',
                'manage_url' => UserResource::getUrl('index'),
                'create_url' => UserResource::getUrl('create'),
            ];
        }

        return [
            'actions' => $actions,
        ];
    }
}

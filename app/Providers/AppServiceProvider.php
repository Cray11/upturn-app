<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Booking\BookingService;
use App\Services\Inquiry\InquiryService;
use App\Services\HR\JobPostingService;
use App\Services\HR\ApplicationService;
use App\Services\CMS\PostService;
use App\Services\Media\MediaService;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BookingService::class);
        $this->app->singleton(InquiryService::class);
        $this->app->singleton(JobPostingService::class);
        $this->app->singleton(ApplicationService::class);
        $this->app->singleton(PostService::class);
        $this->app->singleton(MediaService::class);
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'pages.*'], function ($view): void {
            $view->with(
                'companyProfile',
                config('upturn.company', [])
            );
        });
    }
}

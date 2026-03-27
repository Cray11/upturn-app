<?php

namespace App\Http\Controllers;

use App\Models\Engagement;
use App\Models\JobPosting;
use App\Models\PageContent;
use App\Models\Post;
use App\Models\Service;
use App\Models\Space;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicSiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'contentBlocks' => $this->pageContentMap('home'),
            'services' => $this->transformServices(Service::active()->take(3)->get()),
            'testimonials' => $this->transformTestimonials(Testimonial::featured()->get()),
            'posts' => $this->transformPosts(Post::published()->latest('published_at')->take(3)->get()),
            'jobPostings' => JobPosting::open()->latest()->take(3)->get(),
            'stats' => [
                ['value' => number_format(Service::active()->count()), 'label' => 'Active Services'],
                ['value' => number_format(Space::available()->count()), 'label' => 'Available Spaces'],
                ['value' => number_format(Post::published()->count()), 'label' => 'Published Updates'],
                ['value' => number_format(JobPosting::open()->count()), 'label' => 'Open Roles'],
            ],
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'contentBlocks' => $this->pageContentMap('about'),
            'servicesCount' => Service::active()->count(),
            'spacesCount' => Space::available()->count(),
            'openRolesCount' => JobPosting::open()->count(),
            'publishedPostsCount' => Post::published()->count(),
            'latestPosts' => $this->transformPosts(Post::published()->latest('published_at')->take(3)->get()),
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'contentBlocks' => $this->pageContentMap('services'),
            'services' => $this->transformServices(Service::active()->get()),
            'spaces' => $this->transformSpaces(Space::available()->orderBy('type')->orderBy('name')->get()),
        ]);
    }

    public function engagements(): View
    {
        $engagements = Engagement::published()->ordered()->get();

        return view('pages.engagements', [
            'contentBlocks' => $this->pageContentMap('engagements'),
            'latestProjects' => $this->transformEngagements(
                $engagements->where('section', Engagement::SECTION_LATEST_PROJECTS)->values()
            ),
            'teamBuildingEvents' => $this->transformEngagements(
                $engagements->where('section', Engagement::SECTION_TEAM_BUILDING_EVENTS)->values()
            ),
            'cultureGallery' => $this->transformEngagements(
                $engagements->where('section', Engagement::SECTION_CULTURE_GALLERY)->values()
            ),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'contentBlocks' => $this->pageContentMap('contact'),
            'serviceOptions' => Service::active()->pluck('title')->values(),
        ]);
    }

    public function careers(): View
    {
        return view('pages.careers', [
            'contentBlocks' => $this->pageContentMap('careers'),
            'jobPostings' => JobPosting::open()->latest()->get(),
        ]);
    }

    public function coWorking(): View
    {
        return view('pages.co-working', [
            'contentBlocks' => $this->pageContentMap('co_working'),
        ]);
    }

    public function showCareer(JobPosting $jobPosting): View
    {
        abort_unless($jobPosting->status === 'open', 404);

        return view('pages.job-application', [
            'jobPosting' => $jobPosting,
            'relatedRoles' => JobPosting::open()
                ->whereKeyNot($jobPosting->getKey())
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }

    private function transformServices(Collection $services): Collection
    {
        return $services->map(function (Service $service): array {
            return [
                'title' => $service->title,
                'description' => Str::of((string) $service->description)
                    ->stripTags()
                    ->squish()
                    ->limit(165)
                    ->toString() ?: 'More details about this service will be published soon.',
                'icon' => $this->serviceIcon($service),
                'image_url' => $this->publicImageUrl($service->image),
                'price_label' => $service->price_from ? 'Starts at PHP '.number_format((float) $service->price_from, 2) : null,
            ];
        });
    }

    private function transformSpaces(Collection $spaces): Collection
    {
        return $spaces->map(function (Space $space): array {
            $rateLabel = match (true) {
                filled($space->price_per_hour) => 'PHP '.number_format((float) $space->price_per_hour, 2).' / hour',
                filled($space->price_per_day) => 'PHP '.number_format((float) $space->price_per_day, 2).' / day',
                default => 'Custom quote',
            };

            return [
                'name' => $space->name,
                'type_label' => match ($space->type) {
                    'coworking' => 'Co-Working Space',
                    'virtual_office' => 'Virtual Office',
                    'meeting_room' => 'Meeting Room',
                    default => Str::headline($space->type),
                },
                'description' => Str::of((string) $space->description)
                    ->stripTags()
                    ->squish()
                    ->limit(155)
                    ->toString() ?: 'Ask our team for pricing, amenities, and availability.',
                'capacity' => $space->capacity,
                'rate_label' => $rateLabel,
                'thumbnail_url' => $this->publicImageUrl($space->thumbnail),
            ];
        });
    }

    private function transformPosts(Collection $posts): Collection
    {
        return $posts->map(function (Post $post): array {
            return [
                'title' => $post->title,
                'category' => Str::headline($post->category ?: 'Update'),
                'excerpt' => Str::of((string) $post->body)
                    ->stripTags()
                    ->squish()
                    ->limit(150)
                    ->toString(),
                'published_at_label' => $post->published_at?->format('M j, Y') ?? 'Draft',
                'image_url' => $this->publicImageUrl($post->featured_image),
            ];
        });
    }

    private function transformTestimonials(Collection $testimonials): Collection
    {
        return $testimonials->map(function (Testimonial $testimonial): array {
            return [
                'client_name' => $testimonial->client_name,
                'company' => $testimonial->company,
                'content' => $testimonial->content,
                'rating' => (int) $testimonial->rating,
                'initials' => Str::of($testimonial->client_name)
                    ->explode(' ')
                    ->filter()
                    ->take(2)
                    ->map(fn (string $segment) => Str::substr($segment, 0, 1))
                    ->implode(''),
            ];
        });
    }

    private function transformEngagements(Collection $engagements): Collection
    {
        return $engagements->map(function (Engagement $engagement): array {
            $imageUrls = $engagement->imageUrls();

            return [
                'id' => $engagement->id,
                'section' => $engagement->section,
                'section_label' => $engagement->sectionLabel(),
                'label' => $engagement->label,
                'title' => $engagement->title,
                'description' => $engagement->description,
                'excerpt' => Str::of($engagement->description)->stripTags()->squish()->limit(165)->toString(),
                'images' => $imageUrls,
                'primary_image_url' => $imageUrls[0] ?? null,
                'image_count' => count($imageUrls),
            ];
        });
    }

    private function pageContentMap(string $page): Collection
    {
        return PageContent::published()
            ->where('page', $page)
            ->ordered()
            ->get()
            ->mapWithKeys(function (PageContent $content): array {
                return [
                    $content->section => [[
                        'label' => $content->label,
                        'title' => $content->title,
                        'description' => $content->description,
                        'image_url' => $content->imageUrl(),
                        'primary_button_label' => $content->primary_button_label,
                        'primary_button_url' => $content->primary_button_url,
                        'secondary_button_label' => $content->secondary_button_label,
                        'secondary_button_url' => $content->secondary_button_url,
                    ]],
                ];
            })
            ->map(fn (array $items): array => $items[0]);
    }

    private function publicImageUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }

    private function serviceIcon(Service $service): string
    {
        $label = Str::lower($service->title.' '.$service->slug);

        return match (true) {
            Str::contains($label, 'book') => 'menu_book',
            Str::contains($label, 'tax') => 'receipt_long',
            Str::contains($label, 'regist') => 'app_registration',
            Str::contains($label, 'audit') => 'fact_check',
            Str::contains($label, 'payroll'), Str::contains($label, 'remittance') => 'payments',
            Str::contains($label, 'virtual') => 'language',
            default => 'business_center',
        };
    }
}

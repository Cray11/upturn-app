<?php

namespace Tests\Feature;

use App\Models\Engagement;
use App\Models\JobPosting;
use App\Models\Post;
use App\Models\Service;
use App\Models\Space;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_with_prd_content(): void
    {
        config()->set('upturn.page_sections.home.hero.title', 'Homepage CMS Hero');
        config()->set('upturn.page_sections.home.hero.primary_button_label', 'Book Your Free Consultation Now!');
        config()->set('upturn.page_sections.about.intro.title', 'About foundation managed in CMS');
        config()->set('upturn.page_sections.services.cta.title', 'Workspace CTA from CMS');
        config()->set('upturn.page_sections.contact.cta.title', 'Contact CTA from CMS');
        config()->set('upturn.page_sections.careers.intro.title', 'Culture that rewards growth');
        config()->set('upturn.page_sections.co_working.cta.title', 'Book your workspace visit');
        config()->set('upturn.page_sections.engagements.cta.title', 'Engagement CTA from CMS');

        $author = User::factory()->create();

        $service = Service::create([
            'title' => 'Tax Compliance',
            'slug' => 'tax-compliance',
            'description' => 'Tax filing and compliance support.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $space = Space::create([
            'name' => 'Meeting Room A',
            'type' => 'meeting_room',
            'description' => 'Private meetings and presentations.',
            'capacity' => 10,
            'price_per_hour' => 1500,
            'is_available' => true,
        ]);

        Testimonial::create([
            'client_name' => 'Acme Trading',
            'company' => 'Acme Trading',
            'content' => 'Organized, responsive, and reliable.',
            'rating' => 5,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Post::create([
            'user_id' => $author->id,
            'title' => 'Website Launch',
            'slug' => 'website-launch',
            'body' => 'The new Upturn platform is live.',
            'status' => 'published',
            'category' => 'announcement',
            'published_at' => now(),
        ]);

        Engagement::create([
            'section' => Engagement::SECTION_PARTNER_BUSINESSES,
            'label' => 'Accounting Partner',
            'title' => 'RAM Builders Inc.',
            'description' => 'A long-term partner supported through recurring compliance work.',
            'images' => ['engagements/partner-one.jpg'],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Engagement::create([
            'section' => Engagement::SECTION_CLIENT_SUCCESS_STORIES,
            'label' => 'Tax Compliance',
            'title' => 'BIR Case Handling',
            'description' => 'Expert representation for complex tax audit concerns.',
            'images' => ['engagements/project-one.jpg'],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Engagement::create([
            'section' => Engagement::SECTION_CULTURE_GALLERY,
            'label' => 'Anniversary',
            'title' => '10th Anniversary Gala',
            'description' => 'A celebration of the company milestone.',
            'images' => ['engagements/gallery-one.jpg'],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $jobPosting = JobPosting::create([
            'created_by' => $author->id,
            'title' => 'Accounting Associate',
            'department' => 'Operations',
            'location' => 'Valenzuela City',
            'description' => 'Support accounting and client coordination.',
            'requirements' => 'Attention to detail and communication skills.',
            'employment_type' => 'full_time',
            'status' => 'open',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Homepage CMS Hero')
            ->assertSee('Book Your Free Consultation Now!')
            ->assertSee('Leave a Testimonial')
            ->assertSee($service->title)
            ->assertSee('Acme Trading')
            ->assertSee('Website Launch')
            ->assertSee($jobPosting->title);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('About foundation managed in CMS')
            ->assertSee('Our Mission')
            ->assertSee('Dennis Bayangos, CPA, CTT, MBA');

        $this->get(route('services'))
            ->assertOk()
            ->assertSee('Workspace CTA from CMS')
            ->assertSee($service->title)
            ->assertSee($space->name);

        $this->get(route('engagements'))
            ->assertOk()
            ->assertSee('Partner Businesses')
            ->assertSee('Client Success Stories')
            ->assertSee('Engagement CTA from CMS')
            ->assertSee('RAM Builders Inc.')
            ->assertSee('BIR Case Handling');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Send us a Message')
            ->assertSee('Contact CTA from CMS')
            ->assertSee($service->title);

        $this->get(route('co-working'))
            ->assertOk()
            ->assertSee('Premium Workspaces')
            ->assertSee('Book your workspace visit');

        $this->get(route('careers'))
            ->assertOk()
            ->assertSee('Current Opportunities')
            ->assertSee('Culture that rewards growth')
            ->assertSee('10th Anniversary Gala')
            ->assertSee($jobPosting->title);

        $this->get(route('careers.show', $jobPosting))
            ->assertOk()
            ->assertSee($jobPosting->title)
            ->assertSee('Apply for this role');
    }
}

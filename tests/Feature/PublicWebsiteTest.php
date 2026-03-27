<?php

namespace Tests\Feature;

use App\Models\Engagement;
use App\Models\JobPosting;
use App\Models\PageContent;
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

        PageContent::create([
            'page' => 'home',
            'section' => 'hero',
            'label' => 'Homepage CMS Label',
            'title' => 'Homepage CMS Hero',
            'description' => 'Homepage hero copy managed from the CMS.',
            'primary_button_label' => 'Talk to Sales',
            'primary_button_url' => route('contact'),
            'secondary_button_label' => 'See Engagements',
            'secondary_button_url' => route('engagements'),
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'about',
            'section' => 'intro',
            'label' => 'About CMS Intro',
            'title' => 'About foundation managed in CMS',
            'description' => 'About-page foundation content should now be editable.',
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'services',
            'section' => 'cta',
            'label' => 'Services CMS CTA',
            'title' => 'Workspace CTA from CMS',
            'description' => 'Service-page workspace promotion managed in the CMS.',
            'primary_button_label' => 'Browse Spaces',
            'primary_button_url' => route('co-working'),
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'contact',
            'section' => 'cta',
            'title' => 'Contact CTA from CMS',
            'description' => 'Contact footer banner managed from the CMS.',
            'primary_button_label' => 'Book a Consultation',
            'primary_button_url' => route('contact'),
            'secondary_button_label' => 'View Solutions',
            'secondary_button_url' => route('services'),
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'careers',
            'section' => 'intro',
            'label' => 'Careers CMS Intro',
            'title' => 'Culture that rewards growth',
            'description' => 'Careers culture block managed from the CMS.',
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'co_working',
            'section' => 'cta',
            'label' => 'Coworking CMS CTA',
            'title' => 'Book your workspace visit',
            'description' => 'Coworking booking header managed from the CMS.',
            'is_published' => true,
        ]);

        PageContent::create([
            'page' => 'engagements',
            'section' => 'cta',
            'title' => 'Engagement CTA from CMS',
            'description' => 'Engagement CTA should render from CMS content.',
            'primary_button_label' => 'Partner With Us',
            'primary_button_url' => route('contact'),
            'is_published' => true,
        ]);

        Engagement::create([
            'section' => Engagement::SECTION_LATEST_PROJECTS,
            'label' => 'Tax Compliance',
            'title' => 'BIR Case Handling',
            'description' => 'Expert representation for complex tax audit concerns.',
            'images' => ['engagements/project-one.jpg'],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Engagement::create([
            'section' => Engagement::SECTION_TEAM_BUILDING_EVENTS,
            'label' => 'October 2023',
            'title' => 'Annual Retreat',
            'description' => 'Three days of strategic planning and team bonding.',
            'images' => ['engagements/team-one.jpg', 'engagements/team-two.jpg'],
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
            ->assertSee($service->title)
            ->assertSee('Acme Trading')
            ->assertSee('Website Launch')
            ->assertSee($jobPosting->title);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('About foundation managed in CMS')
            ->assertSee('Live Platform Snapshot')
            ->assertSee('Website Launch');

        $this->get(route('services'))
            ->assertOk()
            ->assertSee('Workspace CTA from CMS')
            ->assertSee($service->title)
            ->assertSee($space->name);

        $this->get(route('engagements'))
            ->assertOk()
            ->assertSee('Life at Upturn')
            ->assertSee('Latest Projects')
            ->assertSee('Engagement CTA from CMS')
            ->assertSee('BIR Case Handling')
            ->assertSee('Annual Retreat')
            ->assertSee('10th Anniversary Gala');

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
            ->assertSee($jobPosting->title);

        $this->get(route('careers.show', $jobPosting))
            ->assertOk()
            ->assertSee($jobPosting->title)
            ->assertSee('Apply for this role');
    }
}

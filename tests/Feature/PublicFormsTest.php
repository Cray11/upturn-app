<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Inquiry;
use App\Models\JobPosting;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\HR\ApplicationReceivedNotification;
use App\Notifications\Inquiry\InquiryReceivedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PublicFormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_creates_an_inquiry_and_notifies_admin(): void
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        Notification::fake();

        $response = $this->post(route('contact.store'), [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'contact_no' => '09171234567',
            'business_name' => 'Jane Ventures',
            'service_interest' => 'Tax Compliance',
            'message' => 'We need help organizing our tax filings.',
        ]);

        $response
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'service_interest' => 'Tax Compliance',
            'source' => 'website',
        ]);

        Notification::assertSentTo($admin, InquiryReceivedNotification::class);
    }

    public function test_coworking_form_creates_an_inquiry_and_notifies_admin(): void
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        Notification::fake();

        $response = $this->post(route('co-working.store'), [
            'name' => 'Mia Founder',
            'email' => 'mia@example.com',
            'contact_no' => '09181234567',
            'space_type' => '8-Seater Conference Room',
            'booking_date' => now()->addDays(2)->toDateString(),
            'booking_time' => '09:30',
        ]);

        $response
            ->assertRedirect(route('co-working').'#booking-form')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Mia Founder',
            'email' => 'mia@example.com',
            'service_interest' => 'Co-Working Space',
            'source' => 'website',
        ]);

        $inquiry = Inquiry::query()->latest('id')->firstOrFail();

        $this->assertStringContainsString('8-Seater Conference Room', $inquiry->message);
        $this->assertStringContainsString('9:30 AM', $inquiry->message);
        Notification::assertSentTo($admin, InquiryReceivedNotification::class);
    }

    public function test_job_application_form_creates_an_application_and_notifies_hr(): void
    {
        Storage::fake('private');
        Role::create(['name' => 'hr']);

        $hr = User::factory()->create([
            'role' => 'hr',
            'is_active' => true,
        ]);

        $jobPosting = JobPosting::create([
            'title' => 'HR Assistant',
            'department' => 'Human Resources',
            'location' => 'Valenzuela City',
            'description' => 'Support the recruitment workflow.',
            'requirements' => 'Good communication skills.',
            'employment_type' => 'full_time',
            'status' => 'open',
        ]);

        Notification::fake();

        $response = $this->post(route('careers.apply', $jobPosting), [
            'applicant_name' => 'Chris Applicant',
            'email' => 'chris@example.com',
            'contact_no' => '09991234567',
            'address' => 'Maysan Road, Valenzuela City',
            'transportation_mode' => 'Bus and tricycle',
            'professional_summary' => 'Three years of admin and recruitment support experience.',
            'educational_background' => 'BS Psychology',
            'recent_company' => 'Example Corp',
            'recent_position' => 'Recruitment Assistant',
            'opportunity_reason' => 'Looking for a role with stronger process ownership.',
            'best_time_to_contact' => 'Weekdays after 2 PM',
            'resume' => UploadedFile::fake()->create('resume.pdf', 120, 'application/pdf'),
        ]);

        $response
            ->assertRedirect(route('careers.show', $jobPosting))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('applications', [
            'job_posting_id' => $jobPosting->id,
            'applicant_name' => 'Chris Applicant',
            'email' => 'chris@example.com',
            'status' => 'new',
        ]);

        $application = Application::query()->firstOrFail();

        Storage::disk('private')->assertExists($application->resume_path);
        Notification::assertSentTo($hr, ApplicationReceivedNotification::class);
        $this->assertDatabaseHas('application_stages', [
            'application_id' => $application->id,
            'stage_name' => 'Application Received',
        ]);
    }

    public function test_testimonial_form_creates_a_submission_for_admin_review(): void
    {
        $response = $this->post(route('testimonials.store'), [
            'client_name' => 'Jamie Client',
            'company' => 'Jamie Ventures',
            'rating' => 5,
            'content' => 'Upturn helped us stay organized and compliant without adding stress to our team.',
        ]);

        $response
            ->assertRedirect(route('home').'#testimonial-form')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('testimonials', [
            'client_name' => 'Jamie Client',
            'company' => 'Jamie Ventures',
            'rating' => 5,
            'is_featured' => false,
        ]);

        $testimonial = Testimonial::query()->latest('id')->firstOrFail();

        $this->assertSame(0, $testimonial->sort_order);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Service;
use App\Models\Space;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_renders_real_operational_data(): void
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
        $admin->syncRoles(['admin']);
        $admin->refresh();

        $space = Space::create([
            'name' => 'Executive Room',
            'type' => 'meeting_room',
            'description' => 'Private board room.',
            'capacity' => 8,
            'price_per_hour' => 1200,
            'is_available' => true,
        ]);

        Inquiry::create([
            'name' => 'Nina Prospect',
            'email' => 'nina@example.com',
            'contact_no' => '09171234567',
            'business_name' => 'Nina Ventures',
            'service_interest' => 'Tax Compliance',
            'message' => 'Need support with filings.',
            'status' => 'new',
            'source' => 'website',
        ]);

        Booking::create([
            'space_id' => $space->id,
            'reference_no' => 'UPT-ADMIN01',
            'booking_date' => today()->addDay(),
            'start_time' => '09:00',
            'end_time' => '11:00',
            'duration_hours' => 2,
            'total_amount' => 2400,
            'status' => 'pending',
        ]);

        Post::create([
            'user_id' => $admin->id,
            'title' => 'Operations Bulletin',
            'slug' => 'operations-bulletin',
            'body' => 'This is a published operational update.',
            'status' => 'published',
            'category' => 'update',
            'published_at' => now(),
        ]);

        Service::create([
            'title' => 'Payroll Support',
            'slug' => 'payroll-support',
            'description' => 'Payroll and remittance management.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($admin, 'web')
            ->get('/admin')
            ->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee('New Inquiries')
            ->assertSee('Platform Activity')
            ->assertSee('Admin Shortcuts')
            ->assertSee('Recent Inquiries')
            ->assertSee('Upcoming Bookings')
            ->assertSee('Nina Prospect')
            ->assertSee('UPT-ADMIN01');
    }
}

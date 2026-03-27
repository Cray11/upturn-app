<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\SiteSetting;
use App\Models\Space;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $hrRole    = Role::firstOrCreate(['name' => 'hr']);
        Role::firstOrCreate(['name' => 'staff']);

        // Permissions
        $permissions = [
            'manage-users','manage-settings','manage-content',
            'manage-bookings','manage-inquiries',
            'manage-jobs','manage-applications',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        $adminRole->syncPermissions($permissions);
        $hrRole->syncPermissions(['manage-jobs','manage-applications']);

        // Super admin
        $admin = User::firstOrCreate(['email' => 'admin@upturnph.com'], [
            'name'      => 'Upturn Admin',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        // HR user
        $hr = User::firstOrCreate(['email' => 'hr@upturnph.com'], [
            'name'      => 'Upturn HR',
            'password'  => Hash::make('password'),
            'role'      => 'hr',
            'is_active' => true,
        ]);
        $hr->assignRole('hr');

        // Site settings
        $settings = [
            ['key'=>'site_name',       'value'=>'Upturn Business Solutions',                                                    'group'=>'general'],
            ['key'=>'site_tagline',    'value'=>'Building Secure and Tax-Compliant Businesses',                                  'group'=>'general'],
            ['key'=>'contact_email',   'value'=>'sales@upturnpartnership.com',                                                   'group'=>'contact'],
            ['key'=>'contact_phone',   'value'=>'+63 921 551 4785',                                                              'group'=>'contact'],
            ['key'=>'contact_address', 'value'=>'Unit 201-202, C&B Circle Mall, Maysan Road, Malinta, Valenzuela City',          'group'=>'contact'],
            ['key'=>'facebook_url',    'value'=>'https://www.facebook.com/UpturnBusinessSolutions/',                             'group'=>'social'],
            ['key'=>'instagram_url',   'value'=>'https://www.instagram.com/upturn.businesssolutions/',                          'group'=>'social'],
        ];
        foreach ($settings as $s) {
            SiteSetting::firstOrCreate(['key' => $s['key']], $s);
        }

        // Spaces
        $spaces = [
            ['name'=>'Co-Working Desk',  'type'=>'coworking',      'capacity'=>1,  'price_per_hour'=>80,   'price_per_day'=>500],
            ['name'=>'Virtual Office',   'type'=>'virtual_office', 'capacity'=>1,  'price_per_hour'=>null, 'price_per_day'=>1500],
            ['name'=>'Meeting Room A',   'type'=>'meeting_room',   'capacity'=>10, 'price_per_hour'=>500,  'price_per_day'=>3000],
            ['name'=>'Conference Room B','type'=>'meeting_room',   'capacity'=>20, 'price_per_hour'=>800,  'price_per_day'=>5000],
        ];
        foreach ($spaces as $s) {
            Space::firstOrCreate(['name' => $s['name']], [...$s, 'is_available' => true]);
        }

        // Services
        $services = [
            ['title'=>'Tax Compliance',      'sort_order'=>1],
            ['title'=>'Bookkeeping',          'sort_order'=>2],
            ['title'=>'Business Registration','sort_order'=>3],
            ['title'=>'Audit Services',       'sort_order'=>4],
            ['title'=>'AFS & ITR',            'sort_order'=>5],
            ['title'=>'Co-Working Space',     'sort_order'=>6],
            ['title'=>'Virtual Office',       'sort_order'=>7],
            ['title'=>'Meeting Room',         'sort_order'=>8],
        ];
        foreach ($services as $s) {
            Service::firstOrCreate(
                ['title' => $s['title']],
                [...$s, 'slug' => Str::slug($s['title']), 'is_active' => true]
            );
        }
    }
}

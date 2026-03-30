<?php
namespace Database\Seeders;

use App\Models\User;
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
            'manage-users','manage-content',
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

        // Staff user
        $staff = User::firstOrCreate(['email' => 'staff@upturnph.com'], [
            'name'      => 'Upturn Staff',
            'password'  => Hash::make('password'),
            'role'      => 'staff',
            'is_active' => true,
        ]);
        $staff->assignRole('staff');
    }
}

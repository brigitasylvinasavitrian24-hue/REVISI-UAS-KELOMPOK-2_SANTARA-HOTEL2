<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $customer = Role::firstOrCreate(['name' => 'customer']);

        Permission::firstOrCreate(['name' => 'manage-rooms']);
        Permission::firstOrCreate(['name' => 'manage-bookings']);
        Permission::firstOrCreate(['name' => 'manage-users']);
        Permission::firstOrCreate(['name' => 'manage-payments']);
        Permission::firstOrCreate(['name' => 'manage-services']);
        Permission::firstOrCreate(['name' => 'view-reports']);

        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['manage-bookings', 'view-reports', 'manage-payments']);
    }
}

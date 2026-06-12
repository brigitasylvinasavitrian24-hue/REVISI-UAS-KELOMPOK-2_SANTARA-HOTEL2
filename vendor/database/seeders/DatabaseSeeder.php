<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            HotelServiceSeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin Santara',
            'email' => 'admin@santara-hotel.com',
            'phone' => '081234567890',
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        $manager = User::factory()->create([
            'name' => 'Manager Santara',
            'email' => 'manager@santara-hotel.com',
            'phone' => '081234567891',
            'role' => 'manager',
        ]);
        $manager->assignRole('manager');

        $customer = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567892',
            'role' => 'customer',
        ]);
        $customer->assignRole('customer');
    }
}

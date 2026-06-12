<?php

namespace Database\Seeders;

use App\Models\HotelService;
use Illuminate\Database\Seeder;

class HotelServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Extra Bed', 'description' => 'Tambahan tempat tidur untuk tamu ketiga', 'price' => 150000],
            ['name' => 'Breakfast', 'description' => 'Sarapan prasmanan setiap pagi', 'price' => 75000],
            ['name' => 'Airport Transfer', 'description' => 'Antar jemput bandara', 'price' => 200000],
            ['name' => 'Laundry', 'description' => 'Layanan cuci dan setrika', 'price' => 50000],
            ['name' => 'Spa Treatment', 'description' => 'Pijat dan perawatan spa', 'price' => 250000],
            ['name' => 'Welcome Dinner', 'description' => 'Makan malam sambutan', 'price' => 150000],
        ];

        foreach ($services as $service) {
            HotelService::create($service);
        }
    }
}

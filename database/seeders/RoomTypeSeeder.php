<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Standard Room',
                'description' => 'Kamar nyaman dengan fasilitas dasar, cocok untuk wisatawan yang hemat.',
                'capacity' => 2,
                'facilities' => ['AC', 'TV', 'Wi-Fi', 'Shower', 'Kamar Mandi Dalam'],
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Kamar lebih luas dengan pemandangan kota dan fasilitas premium.',
                'capacity' => 3,
                'facilities' => ['AC', 'TV 40"', 'Wi-Fi Cepat', 'Bathtub', 'Mini Bar', 'Kamar Mandi Dalam'],
            ],
            [
                'name' => 'Suite Room',
                'description' => 'Suite mewah dengan ruang tamu terpisah, cocok untuk keluarga atau bisnis.',
                'capacity' => 4,
                'facilities' => ['AC', 'TV 50"', 'Wi-Fi Premium', 'Jacuzzi', 'Mini Bar', 'Ruang Tamu', 'Kamar Mandi Dalam', 'Balkon'],
            ],
            [
                'name' => 'Executive Room',
                'description' => 'Kamar eksekutif dengan akses lounge dan layanan butler.',
                'capacity' => 2,
                'facilities' => ['AC', 'TV 43"', 'Wi-Fi Premium', 'Bathtub', 'Mini Bar', 'Akses Lounge', 'Butler Service', 'Kamar Mandi Dalam'],
            ],
        ];

        foreach ($types as $type) {
            RoomType::create($type);
        }
    }
}

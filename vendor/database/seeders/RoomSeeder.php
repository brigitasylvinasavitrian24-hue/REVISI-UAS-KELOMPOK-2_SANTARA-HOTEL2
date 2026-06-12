<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $standard = RoomType::where('name', 'Standard Room')->first();
        $deluxe = RoomType::where('name', 'Deluxe Room')->first();
        $suite = RoomType::where('name', 'Suite Room')->first();
        $executive = RoomType::where('name', 'Executive Room')->first();

        $rooms = [
            ['room_number' => 'STD-01', 'room_type_id' => $standard->id, 'price' => 350000, 'status' => 'available'],
            ['room_number' => 'STD-02', 'room_type_id' => $standard->id, 'price' => 350000, 'status' => 'available'],
            ['room_number' => 'STD-03', 'room_type_id' => $standard->id, 'price' => 350000, 'status' => 'available'],
            ['room_number' => 'STD-04', 'room_type_id' => $standard->id, 'price' => 350000, 'status' => 'available'],
            ['room_number' => 'STD-05', 'room_type_id' => $standard->id, 'price' => 350000, 'status' => 'available'],
            ['room_number' => 'DLX-01', 'room_type_id' => $deluxe->id, 'price' => 650000, 'status' => 'available'],
            ['room_number' => 'DLX-02', 'room_type_id' => $deluxe->id, 'price' => 650000, 'status' => 'available'],
            ['room_number' => 'DLX-03', 'room_type_id' => $deluxe->id, 'price' => 650000, 'status' => 'available'],
            ['room_number' => 'DLX-04', 'room_type_id' => $deluxe->id, 'price' => 750000, 'status' => 'available'],
            ['room_number' => 'STE-01', 'room_type_id' => $suite->id, 'price' => 1200000, 'status' => 'available'],
            ['room_number' => 'STE-02', 'room_type_id' => $suite->id, 'price' => 1200000, 'status' => 'available'],
            ['room_number' => 'EXE-01', 'room_type_id' => $executive->id, 'price' => 950000, 'status' => 'available'],
            ['room_number' => 'EXE-02', 'room_type_id' => $executive->id, 'price' => 950000, 'status' => 'available'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}

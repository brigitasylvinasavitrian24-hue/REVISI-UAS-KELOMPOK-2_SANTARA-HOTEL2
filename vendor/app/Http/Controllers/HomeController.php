<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        $featuredRooms = Room::with('roomType')
            ->where('status', 'available')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('home', compact('roomTypes', 'featuredRooms'));
    }
}

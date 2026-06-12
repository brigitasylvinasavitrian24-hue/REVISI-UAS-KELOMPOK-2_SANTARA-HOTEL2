<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('roomType')->where('status', 'available');

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $query->whereDoesntHave('bookings', function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                      });
                })->whereNotIn('status', ['cancelled']);
            });
        }

        if ($request->filled('room_type')) {
            $query->where('room_type_id', $request->room_type);
        }

        if ($request->filled('guests')) {
            $query->whereHas('roomType', function ($q) use ($request) {
                $q->where('capacity', '>=', $request->guests);
            });
        }

        $sort = $request->get('sort', 'price_asc');
        $query->orderBy('price', $sort === 'price_asc' ? 'asc' : 'desc');

        $rooms = $query->paginate(12);
        $roomTypes = RoomType::all();

        return view('rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show(Room $room)
    {
        $room->load('roomType');
        return view('rooms.show', compact('room'));
    }
}

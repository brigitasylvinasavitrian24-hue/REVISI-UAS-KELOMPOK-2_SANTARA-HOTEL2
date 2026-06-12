<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::where('user_id', auth()->id())->count();
        $confirmedBookings = Booking::where('user_id', auth()->id())->where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
        $recentBookings = Booking::with(['room.roomType'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'recentBookings'
        ));
    }
}
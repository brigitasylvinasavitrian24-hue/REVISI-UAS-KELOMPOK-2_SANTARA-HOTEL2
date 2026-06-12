<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $room = Room::with('roomType')->findOrFail($request->room);
        $services = HotelService::all();

        return view('bookings.create', compact('room', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'services' => 'nullable|array',
            'services.*' => 'exists:hotel_services,id',
        ]);

        $room = Room::with('roomType')->findOrFail($validated['room_id']);

        if ($room->status !== 'available') {
            return back()->withErrors(['room_id' => 'Kamar tidak tersedia.']);
        }

        $days = now()->parse($validated['check_in'])->diffInDays(now()->parse($validated['check_out']));
        $totalPrice = $room->price * $days;

        $selectedServices = collect();
        if (!empty($validated['services'])) {
            $selectedServices = HotelService::whereIn('id', $validated['services'])->get();
            $totalPrice += $selectedServices->sum('price');
        }

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'booking_code' => 'STH-' . strtoupper(Str::random(8)),
                'user_id' => auth()->id(),
                'room_id' => $validated['room_id'],
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'guests' => $validated['guests'],
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            if ($selectedServices->isNotEmpty()) {
                $booking->services()->attach($selectedServices->pluck('id'));
            }

            DB::commit();

            return redirect()->route('bookings.payment', $booking);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal membuat reservasi. Silakan coba lagi.']);
        }
    }

    public function payment(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('bookings.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        $this->authorizeBooking($booking);

        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
        ]);

        $booking->payment()->create([
            'payment_method' => $validated['payment_method'],
            'amount' => $booking->total_price,
            'status' => 'success',
            'transaction_reference' => 'TXN-' . strtoupper(Str::random(12)),
            'paid_at' => now(),
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('bookings.success', $booking);
    }

    public function success(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('bookings.success', compact('booking'));
    }

    public function myBookings()
    {
        $bookings = Booking::with(['room.roomType', 'payment'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.my-bookings', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        $booking->load(['room.roomType', 'payment', 'services']);
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorizeBooking($booking);

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->withErrors(['error' => 'Booking tidak bisa dibatalkan.']);
        }

        $booking->update(['status' => 'cancelled']);

        if ($booking->payment) {
            $booking->payment->update(['status' => 'refunded']);
        }

        return redirect()->route('bookings.my-bookings')->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function invoice(Booking $booking)
    {
        $this->authorizeBooking($booking);
        $booking->load(['room.roomType', 'payment', 'services']);
        return view('bookings.invoice', compact('booking'));
    }

    private function authorizeBooking(Booking $booking): void
    {
        if (auth()->id() !== $booking->user_id) {
            abort(403);
        }
    }
}

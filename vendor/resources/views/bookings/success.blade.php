@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="text-6xl mb-6">✅</div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Booking Berhasil!</h1>
            <p class="text-gray-600 mb-6">Reservasi Anda telah berhasil diproses. Detail booking telah dikirim ke email Anda.</p>

            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Kode Booking</span>
                        <span class="font-bold text-lg text-amber-600">{{ $booking->booking_code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Kamar</span>
                        <span>{{ $booking->room->roomType->name }} ({{ $booking->room->room_number }})</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Check-in</span>
                        <span>{{ $booking->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Check-out</span>
                        <span>{{ $booking->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="text-green-600 font-medium">Confirmed</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Total Dibayar</span>
                        <span class="text-amber-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('bookings.show', $booking) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Lihat Detail Booking
                </a>
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-lg transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

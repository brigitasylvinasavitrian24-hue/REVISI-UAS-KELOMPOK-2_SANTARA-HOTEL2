@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-amber-600">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('bookings.my-bookings') }}" class="text-gray-500 hover:text-amber-600">Booking Saya</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900">Pembayaran</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Pembayaran</h1>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Detail Booking</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Kode Booking</span>
                    <span class="font-medium">{{ $booking->booking_code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Kamar</span>
                    <span class="font-medium">{{ $booking->room->roomType->name }} ({{ $booking->room->room_number }})</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Check-in</span>
                    <span class="font-medium">{{ $booking->check_in->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Check-out</span>
                    <span class="font-medium">{{ $booking->check_out->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tamu</span>
                    <span class="font-medium">{{ $booking->guests }} Orang</span>
                </div>
                <div class="border-t pt-2 mt-2">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-amber-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>
            <form method="POST" action="{{ route('bookings.process-payment', $booking) }}">
                @csrf
                <div class="space-y-3 mb-6">
                    <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="radio" name="payment_method" value="bank_transfer" checked class="text-amber-500 focus:ring-amber-500">
                        <span class="ml-3">
                            <span class="font-medium">Transfer Bank</span>
                            <span class="text-sm text-gray-500 block">BCA, Mandiri, BNI, BRI</span>
                        </span>
                    </label>
                    <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="radio" name="payment_method" value="credit_card" class="text-amber-500 focus:ring-amber-500">
                        <span class="ml-3">
                            <span class="font-medium">Kartu Kredit</span>
                            <span class="text-sm text-gray-500 block">Visa, Mastercard</span>
                        </span>
                    </label>
                    <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="radio" name="payment_method" value="e_wallet" class="text-amber-500 focus:ring-amber-500">
                        <span class="ml-3">
                            <span class="font-medium">E-Wallet</span>
                            <span class="text-sm text-gray-500 block">GoPay, OVO, Dana</span>
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg text-lg transition">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

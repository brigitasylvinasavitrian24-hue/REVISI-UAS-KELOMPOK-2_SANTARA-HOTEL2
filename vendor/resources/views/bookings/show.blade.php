@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-amber-600">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('bookings.my-bookings') }}" class="text-gray-500 hover:text-amber-600">Booking Saya</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900">Detail Booking</span>
        </nav>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                <div class="flex justify-between items-center text-white">
                    <div>
                        <h1 class="text-2xl font-bold">Detail Reservasi</h1>
                        <p class="text-amber-100">Kode: {{ $booking->booking_code }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-medium bg-white text-amber-600">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Kamar</h3>
                        <p class="font-semibold">{{ $booking->room->roomType->name }}</p>
                        <p class="text-sm text-gray-500">Nomor: {{ $booking->room->room_number }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Jumlah Tamu</h3>
                        <p class="font-semibold">{{ $booking->guests }} Orang</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Check-in</h3>
                        <p class="font-semibold">{{ $booking->check_in->format('l, d F Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Check-out</h3>
                        <p class="font-semibold">{{ $booking->check_out->format('l, d F Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Durasi</h3>
                        <p class="font-semibold">{{ $booking->check_in->diffInDays($booking->check_out) }} Malam</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Dibuat Pada</h3>
                        <p class="font-semibold">{{ $booking->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                @if($booking->services->isNotEmpty())
                <div class="border-t pt-6 mb-6">
                    <h3 class="text-lg font-semibold mb-3">Layanan Tambahan</h3>
                    <div class="space-y-2">
                        @foreach($booking->services as $service)
                        <div class="flex justify-between text-sm">
                            <span>{{ $service->name }}</span>
                            <span>Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($booking->notes)
                <div class="border-t pt-6 mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Catatan</h3>
                    <p class="text-gray-700">{{ $booking->notes }}</p>
                </div>
                @endif

                <div class="border-t pt-6 mb-6">
                    <h3 class="text-lg font-semibold mb-3">Pembayaran</h3>
                    @if($booking->payment)
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Metode</span>
                            <span>{{ str_replace('_', ' ', ucfirst($booking->payment->payment_method)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Referensi</span>
                            <span class="font-mono">{{ $booking->payment->transaction_reference }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span class="text-green-600 font-medium">{{ ucfirst($booking->payment->status) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dibayar Pada</span>
                            <span>{{ $booking->payment->paid_at ? $booking->payment->paid_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                    </div>
                    @else
                    <p class="text-gray-500 text-sm">Belum ada pembayaran</p>
                    @endif
                </div>

                <div class="border-t pt-6">
                    <div class="flex justify-between items-center text-xl font-bold">
                        <span>Total</span>
                        <span class="text-amber-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex gap-4 mt-8">
                    <a href="{{ route('bookings.invoice', $booking) }}" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Cetak Invoice
                    </a>
                    @if(in_array($booking->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="flex-1" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                        @csrf
                        <button type="submit" class="w-full text-center bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                            Batalkan Reservasi
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Booking Saya</h1>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if($bookings->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="text-5xl mb-4">📋</div>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Booking</h2>
            <p class="text-gray-500 mb-6">Anda belum melakukan reservasi kamar.</p>
            <a href="{{ route('rooms.index') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                Pesan Kamar Sekarang
            </a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($bookings as $booking)
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-semibold">{{ $booking->room->roomType->name }}</h3>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Kode: <span class="font-mono font-medium">{{ $booking->booking_code }}</span></p>
                        <p class="text-sm text-gray-500">{{ $booking->check_in->format('d M Y') }} - {{ $booking->check_out->format('d M Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->guests }} Tamu</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-amber-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('bookings.show', $booking) }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">Detail</a>
                            @if(in_array($booking->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('bookings.cancel', $booking) }}" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium">Batalkan</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

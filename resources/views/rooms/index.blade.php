@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Cari Kamar</h1>

        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('rooms.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                    <input type="date" name="check_in" value="{{ request('check_in') }}" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                    <input type="date" name="check_out" value="{{ request('check_out') }}" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tamu</label>
                    <select name="guests" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                        @foreach(range(1,6) as $num)
                        <option value="{{ $num }}" {{ request('guests') == $num ? 'selected' : '' }}>{{ $num }} Tamu</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                    <select name="room_type" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">Semua Tipe</option>
                        @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}" {{ request('room_type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-2.5 rounded-lg transition">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        @if($rooms->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Tidak ada kamar yang tersedia dengan kriteria tersebut.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($rooms as $room)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if(!empty($room->photos) && count($room->photos) > 0)
                        <img src="{{ asset('storage/' . $room->photos[0]) }}" alt="{{ $room->roomType->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-6xl">🛏️</span>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold">{{ $room->roomType->name }}</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Tersedia</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-2">Kamar {{ $room->room_number }} | Kapasitas {{ $room->roomType->capacity }} org</p>
                    <p class="text-2xl font-bold text-amber-600 mb-4">Rp {{ number_format($room->price, 0, ',', '.') }}<span class="text-sm text-gray-500 font-normal">/malam</span></p>
                    <div class="flex gap-2 mb-3 flex-wrap">
                        @foreach($room->roomType->facilities ?? [] as $facility)
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $facility }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('rooms.show', $room) }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Lihat Detail & Pesan
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $rooms->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

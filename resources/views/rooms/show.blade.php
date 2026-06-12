@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-amber-600">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('rooms.index') }}" class="text-gray-500 hover:text-amber-600">Kamar</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900">{{ $room->roomType->name }} - {{ $room->room_number }}</span>
        </nav>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gray-200 flex items-center justify-center overflow-hidden">
                @if(!empty($room->photos) && count($room->photos) > 0)
                    <div class="grid grid-cols-1 {{ count($room->photos) > 1 ? 'md:grid-cols-2' : '' }} gap-1 w-full">
                        @foreach($room->photos as $photo)
                            <div class="h-64 md:h-80 overflow-hidden">
                                <img src="{{ asset('storage/' . $photo) }}" alt="{{ $room->roomType->name }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h-64 md:h-80 flex items-center justify-center">
                        <span class="text-8xl">🛏️</span>
                    </div>
                @endif
            </div>
            <div class="p-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $room->roomType->name }}</h1>
                        <p class="text-gray-500 mt-1">Kamar {{ $room->room_number }}</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                </div>

                <p class="text-3xl font-bold text-amber-600 mb-6">Rp {{ number_format($room->price, 0, ',', '.') }}<span class="text-base text-gray-500 font-normal"> / malam</span></p>

                <div class="border-t pt-6">
                    <h2 class="text-xl font-semibold mb-4">Deskripsi</h2>
                    <p class="text-gray-600">{{ $room->roomType->description }}</p>
                </div>

                <div class="border-t pt-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4">Fasilitas</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($room->roomType->facilities ?? [] as $facility)
                        <div class="flex items-center gap-2 text-gray-700">
                            <span class="text-green-500">✓</span>
                            {{ $facility }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t pt-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4">Informasi Kamar</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-500 text-sm">Nomor Kamar</span>
                            <p class="font-medium">{{ $room->room_number }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm">Kapasitas</span>
                            <p class="font-medium">{{ $room->roomType->capacity }} Orang</p>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm">Harga per Malam</span>
                            <p class="font-medium">Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm">Status</span>
                            <p class="font-medium text-green-600">Tersedia</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6 mt-6">
                    @guest
                    <a href="{{ route('login') }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg text-lg transition">
                        Login untuk Memesan
                    </a>
                    @else
                    <a href="{{ route('bookings.create', $room) }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg text-lg transition">
                        Pesan Sekarang
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

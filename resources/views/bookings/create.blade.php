@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-amber-600">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('rooms.index') }}" class="text-gray-500 hover:text-amber-600">Kamar</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900">Booking</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Form Pemesanan</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                <input type="date" name="check_in" value="{{ old('check_in', request('check_in')) }}" min="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('check_in') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                <input type="date" name="check_out" value="{{ old('check_out', request('check_out')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('check_out') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                                <select name="guests" required class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                                    @foreach(range(1, $room->roomType->capacity) as $num)
                                    <option value="{{ $num }}" {{ old('guests') == $num ? 'selected' : '' }}>{{ $num }} Tamu</option>
                                    @endforeach
                                </select>
                                @error('guests') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Permintaan khusus...">{{ old('notes') }}</textarea>
                            @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-3">Layanan Tambahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($services as $service)
                                <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}" class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    <span class="ml-3">
                                        <span class="font-medium">{{ $service->name }}</span>
                                        <span class="text-sm text-gray-500 block">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg text-lg transition">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Kamar</h3>
                    <div class="space-y-3">
                        <div class="h-32 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center">
                            <span class="text-4xl">🛏️</span>
                        </div>
                        <h4 class="font-semibold">{{ $room->roomType->name }}</h4>
                        <p class="text-sm text-gray-500">Kamar {{ $room->room_number }}</p>
                        <p class="text-sm text-gray-500">Kapasitas: {{ $room->roomType->capacity }} orang</p>
                        <div class="border-t pt-3">
                            <p class="text-sm text-gray-500">Harga per malam</p>
                            <p class="text-2xl font-bold text-amber-600">Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                        </div>
                        @if($room->roomType->facilities)
                        <div class="border-t pt-3">
                            <p class="text-sm font-medium text-gray-700 mb-2">Fasilitas:</p>
                            <div class="space-y-1">
                                @foreach($room->roomType->facilities as $facility)
                                <p class="text-sm text-gray-600">✓ {{ $facility }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

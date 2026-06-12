<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Reservasi</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalBookings }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Confirmed</div>
                    <div class="text-3xl font-bold text-green-600">{{ $confirmedBookings }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Pending</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $pendingBookings }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Reservasi Terbaru</h3>
                    @if($recentBookings->isEmpty())
                        <p class="text-gray-500">Belum ada reservasi.</p>
                    @else
                    <div class="space-y-3">
                        @foreach($recentBookings as $booking)
                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <p class="font-medium">{{ $booking->room->roomType->name ?? '-' }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->booking_code }} | {{ $booking->check_in->format('d M') }} - {{ $booking->check_out->format('d M') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('bookings.my-bookings') }}" class="mt-4 inline-block text-amber-600 hover:text-amber-700 font-medium text-sm">Lihat semua →</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('rooms.index') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                Pesan Kamar Baru
            </a>
        </div>
    </div>
</x-app-layout>

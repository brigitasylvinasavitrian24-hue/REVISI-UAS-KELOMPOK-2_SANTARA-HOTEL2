@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="text-center border-b pb-6 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Santara Hotel" class="h-11 w-auto">
                <p class="text-gray-500">Invoice Reservasi</p>
            </div>

            <div class="flex justify-between items-start mb-8">
                <div>
                    <p class="text-sm text-gray-500">Kode Booking</p>
                    <p class="text-xl font-bold text-amber-600">{{ $booking->booking_code }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p>{{ now()->format('d M Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Data Pemesan</h3>
                    <p class="font-semibold">{{ $booking->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->user->phone }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Detail Kamar</h3>
                    <p class="font-semibold">{{ $booking->room->roomType->name }}</p>
                    <p class="text-sm text-gray-500">Kamar {{ $booking->room->room_number }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->guests }} Tamu</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Check-in</h3>
                    <p class="font-semibold">{{ $booking->check_in->format('l, d F Y') }}</p>
                    <p class="text-sm text-gray-500">14:00 WIB</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Check-out</h3>
                    <p class="font-semibold">{{ $booking->check_out->format('l, d F Y') }}</p>
                    <p class="text-sm text-gray-500">12:00 WIB</p>
                </div>
            </div>

            <table class="w-full mb-8">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 text-sm font-medium text-gray-500">Item</th>
                        <th class="text-center py-2 text-sm font-medium text-gray-500">Durasi</th>
                        <th class="text-right py-2 text-sm font-medium text-gray-500">Harga</th>
                        <th class="text-right py-2 text-sm font-medium text-gray-500">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-3">{{ $booking->room->roomType->name }}</td>
                        <td class="text-center py-3">{{ $booking->check_in->diffInDays($booking->check_out) }} malam</td>
                        <td class="text-right py-3">Rp {{ number_format($booking->room->price, 0, ',', '.') }}</td>
                        <td class="text-right py-3">Rp {{ number_format($booking->room->price * $booking->check_in->diffInDays($booking->check_out), 0, ',', '.') }}</td>
                    </tr>
                    @foreach($booking->services as $service)
                    <tr class="border-b">
                        <td class="py-3">{{ $service->name }}</td>
                        <td class="text-center py-3">1</td>
                        <td class="text-right py-3">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="text-right py-3">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right py-3 font-bold text-lg">Total</td>
                        <td class="text-right py-3 font-bold text-lg text-amber-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            @if($booking->payment && $booking->payment->status === 'success')
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8">
                <p class="text-green-700 font-medium">✓ LUNAS</p>
                <p class="text-sm text-green-600">Pembayaran via {{ str_replace('_', ' ', ucfirst($booking->payment->payment_method)) }} pada {{ $booking->payment->paid_at->format('d M Y H:i') }}</p>
                <p class="text-sm text-green-600">Referensi: {{ $booking->payment->transaction_reference }}</p>
            </div>
            @endif

            <div class="border-t pt-6 text-center text-sm text-gray-500">
                <p>Terima kasih telah memesan di Santara Hotel</p>
                <p class="mt-1">Harap simpan invoice ini sebagai bukti reservasi</p>
            </div>

            <div class="flex gap-4 mt-8">
                <a href="{{ route('bookings.show', $booking) }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-lg transition">
                    Kembali
                </a>
                <button onclick="window.print()" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Cetak PDF
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

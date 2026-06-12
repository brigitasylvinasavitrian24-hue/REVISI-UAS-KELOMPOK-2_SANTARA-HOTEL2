<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Booking::with(['user', 'room.roomType', 'payment'])
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Pemesan',
            'Email',
            'Telepon',
            'Kamar',
            'Tipe Kamar',
            'Check-in',
            'Check-out',
            'Tamu',
            'Total Harga',
            'Status',
            'Metode Pembayaran',
            'Status Pembayaran',
            'Tanggal Booking',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->booking_code,
            $booking->user->name,
            $booking->user->email,
            $booking->user->phone,
            $booking->room->room_number,
            $booking->room->roomType->name,
            $booking->check_in->format('d/m/Y'),
            $booking->check_out->format('d/m/Y'),
            $booking->guests,
            'Rp ' . number_format($booking->total_price, 0, ',', '.'),
            $booking->status,
            $booking->payment?->payment_method ?? '-',
            $booking->payment?->status ?? '-',
            $booking->created_at->format('d/m/Y H:i'),
        ];
    }
}

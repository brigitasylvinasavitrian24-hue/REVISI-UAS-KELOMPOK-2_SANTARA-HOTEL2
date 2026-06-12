<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $totalBookings = Booking::count();
        $totalRevenue = Payment::where('status', 'success')->sum('amount');
        $occupancyRate = Room::where('status', 'occupied')->count();
        $totalRooms = Room::count();

        return [
            Stat::make('Total Reservasi', $totalBookings)
                ->description('Semua reservasi')
                ->color('primary'),
            Stat::make('Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pendapatan')
                ->color('success'),
            Stat::make('Kamar Terisi', $occupancyRate . '/' . $totalRooms)
                ->description('Tingkat okupansi')
                ->color('warning'),
            Stat::make('Reservasi Hari Ini', Booking::whereDate('created_at', today())->count())
                ->description('Reservasi baru hari ini')
                ->color('info'),
        ];
    }
}

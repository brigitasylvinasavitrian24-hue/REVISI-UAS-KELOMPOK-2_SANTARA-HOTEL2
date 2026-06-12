<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BookingChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Reservasi Bulanan';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $bookings = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = collect(range(1, 12))->map(fn ($m) => now()->month($m)->format('M'));

        $values = collect(range(1, 12))->map(
            fn ($m) => $bookings->firstWhere('month', $m)?->total ?? 0
        );

        return [
            'datasets' => [
                [
                    'label' => 'Reservasi',
                    'data' => $values->toArray(),
                    'backgroundColor' => '#60a5fa',
                    'borderColor' => '#3b82f6',
                    'fill' => false,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

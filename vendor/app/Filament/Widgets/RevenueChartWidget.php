<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RevenueChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Pendapatan Bulanan';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $revenue = Payment::where('status', 'success')
            ->select(
                DB::raw('MONTH(paid_at) as month'),
                DB::raw('YEAR(paid_at) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('paid_at', now()->year)
            ->groupBy(DB::raw('YEAR(paid_at)'), DB::raw('MONTH(paid_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = collect(range(1, 12))->map(fn ($m) => now()->month($m)->format('M'));

        $values = collect(range(1, 12))->map(
            fn ($m) => $revenue->firstWhere('month', $m)?->total ?? 0
        );

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $values->map(fn ($v) => (float) $v)->toArray(),
                    'backgroundColor' => '#34d399',
                    'borderColor' => '#10b981',
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

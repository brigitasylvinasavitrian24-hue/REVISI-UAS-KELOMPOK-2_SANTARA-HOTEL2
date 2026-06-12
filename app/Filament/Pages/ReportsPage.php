<?php

namespace App\Filament\Pages;

use App\Exports\BookingsExport;
use App\Models\Booking;
use App\Models\Payment;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Laporan';

    protected string $view = 'filament.pages.reports';

    public $startDate;

    public $endDate;

    public $showResults = false;

    public $stats = [];

    public function mount(): void
    {
        abort_unless(in_array(auth()->user()?->role, ['admin', 'manager']), 403);

        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function tampilkan()
    {
        $validated = validator([
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ])->validate();

        $this->startDate = $validated['startDate'];
        $this->endDate = $validated['endDate'];

        $start = $this->startDate;
        $end = $this->endDate . ' 23:59:59';

        $bookingQuery = Booking::whereBetween('created_at', [$start, $end]);
        $paymentQuery = Payment::where('status', 'success')
            ->whereHas('booking', fn ($q) => $q->whereBetween('created_at', [$start, $end]));

        $daily = (clone $bookingQuery)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $totalRevenue = (clone $paymentQuery)->sum('amount');
        $totalBookings = (clone $bookingQuery)->count();

        $this->stats = [
            'total' => $totalBookings,
            'confirmed' => (clone $bookingQuery)->where('status', 'confirmed')->count(),
            'cancelled' => (clone $bookingQuery)->where('status', 'cancelled')->count(),
            'revenue' => $totalRevenue,
            'daily' => $daily,
            'avgPerDay' => $daily->count() > 0 ? round($totalBookings / $daily->count(), 1) : 0,
            'avgRevenuePerDay' => $daily->count() > 0 ? round($totalRevenue / $daily->count()) : 0,
            'totalDays' => $daily->count(),
        ];

        $this->showResults = true;
    }

    public function export()
    {
        $validated = validator([
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ])->validate();

        return Excel::download(
            new BookingsExport($validated['startDate'], $validated['endDate']),
            'laporan-reservasi-' . $validated['startDate'] . '-sd-' . $validated['endDate'] . '.xlsx'
        );
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->hasRole(['admin', 'manager']) ?? false;
    }
}

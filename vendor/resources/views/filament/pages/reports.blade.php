<x-filament::page>
    <x-filament::card>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
                <input type="date" wire:model="startDate" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" wire:model="endDate" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div>
                <x-filament::button wire:click="tampilkan" icon="heroicon-m-magnifying-glass" class="w-full">
                    Tampilkan
                </x-filament::button>
            </div>
            @if($showResults)
            <div>
                <x-filament::button wire:click="export" icon="heroicon-m-arrow-down-tray" color="success" class="w-full">
                    Export Excel
                </x-filament::button>
            </div>
            <div>
                <x-filament::button onclick="window.print()" icon="heroicon-m-printer" color="gray" class="w-full">
                    Cetak
                </x-filament::button>
            </div>
            @endif
        </div>
    </x-filament::card>

    @if($showResults)
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 my-6">
        <x-filament::card class="border-t-4 !border-t-primary-500">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-primary-100">
                    <x-filament::icon icon="heroicon-m-calendar-days" class="w-5 h-5 text-primary-600" />
                </div>
                <div>
                    <div class="text-xs text-gray-500">Total Reservasi</div>
                    <div class="text-xl font-bold">{{ $stats['total'] }}</div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card class="border-t-4 !border-t-success-500">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-success-100">
                    <x-filament::icon icon="heroicon-m-check-circle" class="w-5 h-5 text-success-600" />
                </div>
                <div>
                    <div class="text-xs text-gray-500">Confirmed</div>
                    <div class="text-xl font-bold">{{ $stats['confirmed'] }}</div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card class="border-t-4 !border-t-danger-500">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-danger-100">
                    <x-filament::icon icon="heroicon-m-x-circle" class="w-5 h-5 text-danger-600" />
                </div>
                <div>
                    <div class="text-xs text-gray-500">Dibatalkan</div>
                    <div class="text-xl font-bold">{{ $stats['cancelled'] }}</div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card class="border-t-4 !border-t-warning-500">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-warning-100">
                    <x-filament::icon icon="heroicon-m-banknotes" class="w-5 h-5 text-warning-600" />
                </div>
                <div>
                    <div class="text-xs text-gray-500">Pendapatan</div>
                    <div class="text-xl font-bold">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card class="border-t-4 !border-t-info-500">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-info-100">
                    <x-filament::icon icon="heroicon-m-chart-bar" class="w-5 h-5 text-info-600" />
                </div>
                <div>
                    <div class="text-xs text-gray-500">Rata-rata/Hari</div>
                    <div class="text-xl font-bold">Rp {{ number_format($stats['avgRevenuePerDay'], 0, ',', '.') }}</div>
                </div>
            </div>
        </x-filament::card>
    </div>

    <x-filament::card>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-semibold text-gray-900">Rincian Harian</h3>
                <p class="text-sm text-gray-500">{{ $stats['totalDays'] }} hari &mdash; {{ $startDate }} s/d {{ $endDate }}</p>
            </div>
            <div class="text-right text-sm text-gray-500">
                Rata-rata <strong>{{ $stats['avgPerDay'] }}</strong> reservasi/hari
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Tanggal</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Reservasi</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($stats['daily'] as $day)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($day->date)->isoFormat('DD MMM YYYY') }}</td>
                        <td class="px-6 py-3 text-right">{{ $day->total }}</td>
                        <td class="px-6 py-3 text-right font-medium">Rp {{ number_format($day->revenue, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            Tidak ada data untuk rentang tanggal ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($stats['daily']->isNotEmpty())
                <tfoot>
                    <tr class="bg-gray-100 font-semibold">
                        <td class="px-6 py-3 text-xs uppercase tracking-wide text-gray-600">Total</td>
                        <td class="px-6 py-3 text-right">{{ $stats['total'] }}</td>
                        <td class="px-6 py-3 text-right">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </x-filament::card>
    @endif

    <style>
        @media print {
            body { background: white !important; }
            .fi-sidebar, .fi-topbar, button.w-full { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; max-width: 100% !important; }
            .fi-main > div { max-width: 100% !important; }
            @page { margin: 1.5cm; }
        }
    </style>
</x-filament::page>

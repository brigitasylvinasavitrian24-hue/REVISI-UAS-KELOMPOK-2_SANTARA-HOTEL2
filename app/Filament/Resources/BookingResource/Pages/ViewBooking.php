<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Section::make('Informasi Reservasi')
                            ->columnSpan(2)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('booking_code')
                                            ->label('Kode Booking'),
                                        TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'pending' => 'warning',
                                                'confirmed' => 'success',
                                                'checked_in' => 'info',
                                                'checked_out' => 'primary',
                                                'cancelled' => 'danger',
                                                default => 'gray',
                                            }),
                                        TextEntry::make('check_in')
                                            ->label('Check In')
                                            ->date(),
                                        TextEntry::make('check_out')
                                            ->label('Check Out')
                                            ->date(),
                                        TextEntry::make('guests')
                                            ->label('Jumlah Tamu'),
                                        TextEntry::make('total_price')
                                            ->label('Total Harga')
                                            ->money('IDR'),
                                        TextEntry::make('created_at')
                                            ->label('Tanggal Booking')
                                            ->dateTime(),
                                    ]),
                                TextEntry::make('notes')
                                    ->label('Catatan')
                                    ->visible(fn ($state): bool => filled($state)),
                            ]),
                        Section::make('Informasi Pemesan')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Nama'),
                                TextEntry::make('user.email')
                                    ->label('Email'),
                                TextEntry::make('user.phone')
                                    ->label('Telepon'),
                            ]),
                    ]),
                Grid::make(2)
                    ->schema([
                        Section::make('Kamar')
                            ->schema([
                                TextEntry::make('room.room_number')
                                    ->label('Nomor Kamar'),
                                TextEntry::make('room.roomType.name')
                                    ->label('Tipe Kamar'),
                                TextEntry::make('room.price')
                                    ->label('Harga/Malam')
                                    ->money('IDR'),
                            ]),
                        Section::make('Pembayaran')
                            ->schema([
                                TextEntry::make('payment.payment_method')
                                    ->label('Metode')
                                    ->default('-'),
                                TextEntry::make('payment.amount')
                                    ->label('Jumlah')
                                    ->money('IDR')
                                    ->default('-'),
                                TextEntry::make('payment.status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'success' => 'success',
                                        'failed' => 'danger',
                                        'refunded' => 'gray',
                                        default => 'gray',
                                    })
                                    ->default('-'),
                                TextEntry::make('payment.transaction_reference')
                                    ->label('Referensi')
                                    ->default('-'),
                                TextEntry::make('payment.paid_at')
                                    ->label('Dibayar')
                                    ->dateTime()
                                    ->default('-'),
                            ]),
                    ]),
                Section::make('Layanan Tambahan')
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('services')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Layanan'),
                                TextEntry::make('price')
                                    ->label('Harga')
                                    ->money('IDR'),
                            ])
                            ->visible(fn ($state): bool => filled($state) && count($state) > 0),
                    ]),
            ]);
    }
}

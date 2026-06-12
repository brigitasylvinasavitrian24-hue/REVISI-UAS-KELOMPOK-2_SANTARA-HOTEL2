<?php

namespace App\Filament\Resources\HotelServiceResource\Pages;

use App\Filament\Resources\HotelServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelService extends EditRecord
{
    protected static string $resource = HotelServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

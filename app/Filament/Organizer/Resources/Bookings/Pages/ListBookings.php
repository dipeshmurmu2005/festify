<?php

namespace App\Filament\Organizer\Resources\Bookings\Pages;

use App\Filament\Organizer\Resources\Bookings\BookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

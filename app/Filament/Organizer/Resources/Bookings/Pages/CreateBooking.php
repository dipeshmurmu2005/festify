<?php

namespace App\Filament\Organizer\Resources\Bookings\Pages;

use App\Filament\Organizer\Resources\Bookings\BookingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;
}

<?php

namespace App\Filament\Organizer\Resources\TicketReservations\Pages;

use App\Filament\Organizer\Resources\TicketReservations\TicketReservationResource;
use Filament\Resources\Pages\ListRecords;

class ListTicketReservations extends ListRecords
{
    protected static string $resource = TicketReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

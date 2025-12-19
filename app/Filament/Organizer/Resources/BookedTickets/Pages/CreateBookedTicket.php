<?php

namespace App\Filament\Organizer\Resources\BookedTickets\Pages;

use App\Filament\Organizer\Resources\BookedTickets\BookedTicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookedTicket extends CreateRecord
{
    protected static string $resource = BookedTicketResource::class;
}

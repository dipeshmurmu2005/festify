<?php

namespace App\Filament\Organizer\Resources\Tickets\Pages;

use App\Filament\Organizer\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}

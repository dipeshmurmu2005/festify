<?php

namespace App\Services\Organizer;

use App\Enums\TicketReservationStatusEnum;
use App\Models\BookedTicket;
use App\Models\TicketReservation;

class OrganizerStatsService
{

    public function ticketsSold()
    {
        return BookedTicket::count();
    }

    public function activeReservation()
    {
        return TicketReservation::whereNotIn('status', [
            TicketReservationStatusEnum::EXPIRED->value,
            TicketReservationStatusEnum::CANCELLED->value,
        ])->count();
    }
}

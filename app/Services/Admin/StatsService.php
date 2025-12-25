<?php

namespace App\Services\Admin;

use App\Enums\TicketReservationStatusEnum;
use App\Models\BookedTicket;
use App\Models\Organizer;
use App\Models\TicketReservation;
use App\Models\User;

class StatsService
{

    public function ticketsSold()
    {
        return BookedTicket::whereYear('created_at', now()->year)->count();
    }

    public function totalUsers()
    {
        return User::whereYear('created_at', now()->year)->count();
    }

    public function totalOrganizers()
    {
        return Organizer::whereYear('created_at', now()->year)->count();
    }

    public function activeReservation()
    {
        return TicketReservation::whereNotIn('status', [
            TicketReservationStatusEnum::EXPIRED->value,
            TicketReservationStatusEnum::CANCELLED->value,
        ])->whereYear('created_at', now()->year)->count();
    }
}

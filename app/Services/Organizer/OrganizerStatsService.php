<?php

namespace App\Services\Organizer;

use App\Enums\TicketReservationStatusEnum;
use App\Enums\WalletTransactionTypeEnum;
use App\Models\BookedTicket;
use App\Models\TicketReservation;

class OrganizerStatsService
{

    public function ticketsSold()
    {
        return BookedTicket::whereYear('created_at', now()->year)->count();
    }

    public function activeReservation()
    {
        return TicketReservation::whereNotIn('status', [
            TicketReservationStatusEnum::EXPIRED->value,
            TicketReservationStatusEnum::CANCELLED->value,
        ])->whereYear('created_at', now()->year)->count();
    }

    public function walletBalance()
    {
        return 'Rs. ' . auth()->user()->organizer->wallet->balance;
    }

    public function totalRevenue()
    {
        return auth()->user()->organizer->wallet->transactions()->whereYear('created_at', now()->year)->where('type', WalletTransactionTypeEnum::Credit)->sum('amount');
    }
}

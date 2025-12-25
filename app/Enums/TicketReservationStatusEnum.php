<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TicketReservationStatusEnum: string implements HasLabel, HasColor
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
    case PAYMENT_INITIATED = 'payment initiated';
    case PAYMENT_DONE = 'payment done';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::EXPIRED => 'Expired',
            self::PAYMENT_INITIATED => 'Payment Initiated',
            self::CANCELLED => 'Cancelled',
            self::PAYMENT_DONE => 'Payment Done'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ACTIVE    => 'success',
            self::EXPIRED   => 'gray',
            self::PAYMENT_INITIATED => 'info',
            self::CANCELLED => 'danger',
            self::PAYMENT_DONE => 'success',
        };
    }
}

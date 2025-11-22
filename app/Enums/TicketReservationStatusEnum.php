<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TicketReservationStatusEnum: string implements HasLabel, HasColor
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CONVERTED = 'converted';
    case CANCELLED = 'cancelled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::EXPIRED => 'Expired',
            self::CONVERTED => 'Converted',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ACTIVE    => 'success',
            self::EXPIRED   => 'gray',
            self::CONVERTED => 'info',
            self::CANCELLED => 'danger',
        };
    }
}

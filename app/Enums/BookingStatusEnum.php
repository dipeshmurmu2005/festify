<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BookingStatusEnum: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING   => 'Pending',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::REFUNDED  => 'Refunded',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING   => 'yellow',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
            self::REFUNDED  => 'warning',
        };
    }
}

<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TicketStatusEnum: string implements HasLabel, HasColor
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SOLD_OUT = 'sold_out';
    case EXPIRED = 'expired';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::SOLD_OUT => 'Sold Out',
            self::INACTIVE => 'In Active',
            self::EXPIRED => 'Expired',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::SOLD_OUT => 'info',
            self::INACTIVE => 'danger',
            self::EXPIRED => 'warning',
        };
    }
}

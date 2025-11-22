<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TicketStatusEnum: string implements HasLabel
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
}

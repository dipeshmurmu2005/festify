<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TicketTypeEnum: string implements HasLabel
{
    case FREE = 'free';
    case PAID = 'paid';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FREE => 'Free',
            self::PAID => 'Paid',
        };
    }
}

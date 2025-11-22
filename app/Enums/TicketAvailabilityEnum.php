<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TicketAvailabilityEnum: string implements HasLabel
{
    case DateTime = 'date&time';
    case WhenSalesEndFor = 'whensalesendfor';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DateTime => 'Date & Time',
            self::WhenSalesEndFor => 'When Sales End For'
        };
    }
}

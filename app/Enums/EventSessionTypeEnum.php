<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EventSessionTypeEnum: string implements HasLabel
{
    case DAY_SPECIFIC = 'day_specific';
    case EVERY_DAY = 'every_day';

    public function getLabel(): string
    {
        return match ($this) {
            self::DAY_SPECIFIC => 'Day Specific',
            self::EVERY_DAY => 'Every Day of Event',
        };
    }
}

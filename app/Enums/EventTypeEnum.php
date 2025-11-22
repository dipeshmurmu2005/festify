<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EventTypeEnum: string implements HasLabel
{
    case SingleDay = 'single day';
    case AcrossDays = 'across days';
    case AcrossDaysFullPackage = 'across days full package';
    case RecurringEvent = 'recurring event';

    public function getLabel(): string
    {
        return match ($this) {
            self::SingleDay => 'Single Day',
            self::AcrossDays => 'Across Days',
            self::AcrossDaysFullPackage => 'Across Days (Full Package)',
            self::RecurringEvent => 'Recurring Event',
        };
    }
}

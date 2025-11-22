<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AttendeeTypeEnum: string implements HasLabel
{
    case  REGISTEREDATTENDEE = 'registered attendee';
    case UNREGISTEREDATTENDEE = 'unregistered attendee';

    public function getLabel(): string
    {
        return match ($this) {
            self::REGISTEREDATTENDEE => 'Registered Attendee',
            self::UNREGISTEREDATTENDEE => 'Unregistered Attendee',
        };
    }
}

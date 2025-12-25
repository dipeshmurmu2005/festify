<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TicketCapacityTypeEnum: string implements HasLabel
{
    case INDIVIDUAL = 'individual';
    case SHAREDWITHEVENT = 'shared with venue';
    case SHAREDWITHSESSION = 'shared with session';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::INDIVIDUAL => 'Individual',
            self::SHAREDWITHEVENT => 'Shared With Event',
            self::SHAREDWITHSESSION => 'Shared With Session',
        };
    }
}

<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EventsPriceSortEnum: string implements HasLabel
{
    case LOWTOHIGH = 'low to high';
    case HIGHTOLOW = 'high to low';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOWTOHIGH => 'Price Low To High',
            self::HIGHTOLOW => 'Price High to Low',
        };
    }
}

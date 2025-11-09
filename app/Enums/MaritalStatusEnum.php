<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MaritalStatusEnum: string implements HasLabel
{
    case Married = 'married';
    case Single = 'single';

    public function getLabel(): string
    {
        return match ($this) {
            self::Married => 'Married',
            self::Single => 'Single',
        };
    }
}

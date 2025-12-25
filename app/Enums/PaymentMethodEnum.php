<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethodEnum: string implements HasLabel, HasColor
{
    case Esewa = 'esewa';
    public function getLabel(): string
    {
        return match ($this) {
            self::Esewa => 'eSewa',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Esewa => 'success',
        };
    }
}

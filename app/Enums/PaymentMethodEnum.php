<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethodEnum: string implements HasLabel, HasColor
{
    case Esewa = 'esewa';
    case Bank = 'bank';
    public function getLabel(): string
    {
        return match ($this) {
            self::Esewa => 'eSewa',
            self::Bank => 'Bank'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Esewa => 'success',
            self::Bank => 'primary'
        };
    }
}

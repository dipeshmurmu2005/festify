<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum: string implements HasLabel, HasColor
{
    case Paid = 'paid';
    case Pending = 'pending';
    case PartiallyPaid = 'paritally paid';

    public function getLabel(): string
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::Pending => 'Pending',
            self::PartiallyPaid => 'Partially Paid'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Paid => 'success',
            self::Pending => 'danger',
            self::PartiallyPaid => 'warning'
        };
    }
}

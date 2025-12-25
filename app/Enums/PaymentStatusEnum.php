<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum: string implements HasLabel, HasColor
{
    case Verified = 'verified';
    case Pending = 'pending';
    case Failed = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Verified => 'Verified',
            self::Pending => 'Pending',
            self::Failed => 'Failed'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Verified => 'success',
            self::Failed => 'danger',
            self::Pending => 'warning'
        };
    }
}

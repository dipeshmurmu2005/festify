<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EventStatusEnum: string implements HasLabel, HasColor
{
    case Draft = 'draft';
    case Published = 'published';
    case Cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Cancelled => 'Cancelled',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Draft     => 'warning',
            self::Published => 'success',
            self::Cancelled => 'danger',
        };
    }
}

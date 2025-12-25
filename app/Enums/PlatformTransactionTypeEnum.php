<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PlatformTransactionTypeEnum: string implements HasLabel, HasColor, HasIcon
{
    case CREDIT = 'credit';
    case DEBIT = 'debit';

    public function getLabel(): string
    {
        return match ($this) {
            self::CREDIT => 'Credit',
            self::DEBIT => 'Debit',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CREDIT => 'success',
            self::DEBIT => 'danger',
        };
    }

    // Return Heroicon name
    public function getIcon(): string
    {
        return match ($this) {
            self::CREDIT => 'heroicon-m-arrow-down-circle',
            self::DEBIT => 'heroicon-m-arrow-up-circle',
        };
    }
}

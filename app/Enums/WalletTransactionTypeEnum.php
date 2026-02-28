<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum WalletTransactionTypeEnum: string implements HasLabel, HasColor
{
    case Debit = 'debit';
    case Credit = 'credit';

    public function getLabel(): string
    {
        return match ($this) {
            self::Debit => 'Debit',
            self::Credit => 'Credit',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Debit => 'warning',
            self::Credit => 'success',
        };
    }
}

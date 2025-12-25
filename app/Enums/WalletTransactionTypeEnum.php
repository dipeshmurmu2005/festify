<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WalletTransactionTypeEnum: string implements HasLabel
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
}

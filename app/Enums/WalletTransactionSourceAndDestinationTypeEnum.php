<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WalletTransactionSourceAndDestinationTypeEnum: string implements HasLabel
{
    case Platform = 'platform transactions';
    case Bank = 'bank';
    case Gateway = 'gateway';
    case Wallet = 'wallet';


    public function getLabel(): string
    {
        return match ($this) {
            self::Platform => 'Platform Transactions',
            self::Bank => 'Bank',
            self::Gateway => 'Gateway',
            self::Wallet => 'Wallet',
        };
    }
}

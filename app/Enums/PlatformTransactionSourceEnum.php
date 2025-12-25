<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PlatformTransactionSourceEnum: string implements HasLabel, HasColor, HasIcon
{
    case TICKET_PURCHASE = 'ticket_purchase';
    case FEATURED_EVENT = 'featured_event';
    case COMMISSION = 'commission';
    case REFUND = 'refund';
    case WALLET_TOPUP = 'wallet_topup';
    case MANUAL = 'manual';

    public function getLabel(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'Ticket Purchase',
            self::FEATURED_EVENT => 'Featured Event',
            self::COMMISSION => 'Commission',
            self::REFUND => 'Refund',
            self::WALLET_TOPUP => 'Wallet Topup',
            self::MANUAL => 'Manual',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'info',
            self::FEATURED_EVENT => 'success',
            self::COMMISSION => 'warning',
            self::REFUND => 'accent',
            self::WALLET_TOPUP => 'success',
            self::MANUAL => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'heroicon-m-ticket',
            self::FEATURED_EVENT => 'heroicon-m-star',
            self::COMMISSION => 'heroicon-m-currency-dollar',
            self::REFUND => 'heroicon-m-arrow-uturn-left',
            self::WALLET_TOPUP => 'heroicon-m-wallet',
            self::MANUAL => 'heroicon-m-adjustments',
        };
    }
}

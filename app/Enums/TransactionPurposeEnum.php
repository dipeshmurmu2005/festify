<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TransactionPurposeEnum: string implements HasLabel, HasIcon, HasColor
{
    case TICKET_PURCHASE = 'ticket_purchase';
    case TICKET_EARNING = 'ticket_earning';
    case PAYOUT = 'payout';
    case REFUND = 'refund';
    case FEATURED_LISTING = 'featured_listing';
    case PROMOTION = 'promotion';
    case ADJUSTMENT = 'adjustment';
    case COMMISSION = 'commission';

    public function getLabel(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'Ticket Purchase',
            self::TICKET_EARNING => 'Ticket Earning',
            self::PAYOUT => 'Payout',
            self::REFUND => 'Refund',
            self::FEATURED_LISTING => 'Featured Listing',
            self::PROMOTION => 'Promotion',
            self::ADJUSTMENT => 'Adjustment',
            self::COMMISSION => 'Commission',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'heroicon-m-ticket',
            self::TICKET_EARNING => 'heroicon-m-currency-dollar',
            self::PAYOUT => 'heroicon-m-banknotes',
            self::REFUND => 'heroicon-m-arrow-left',
            self::FEATURED_LISTING => 'heroicon-m-star',
            self::PROMOTION => 'heroicon-m-gift',
            self::ADJUSTMENT => 'heroicon-m-adjustments-horizontal',
            self::COMMISSION => 'heroicon-m-cash',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::TICKET_PURCHASE => 'primary',
            self::TICKET_EARNING => 'success',
            self::PAYOUT => 'warning',
            self::REFUND => 'danger',
            self::FEATURED_LISTING => 'info',
            self::PROMOTION => 'secondary',
            self::ADJUSTMENT => 'gray',
            self::COMMISSION => 'success',
        };
    }
}

<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum WithdrawalRequestEnum: string implements HasLabel, HasIcon, HasColor
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Processing = 'processing';
    case Paid = 'paid';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
    case Failed = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Processing => 'Processing',
            self::Paid => 'Paid',
            self::Rejected => 'Rejected',
            self::Cancelled => 'Cancelled',
            self::Failed => 'Failed',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Approved => 'heroicon-o-check-circle',
            self::Processing => 'heroicon-o-arrow-path',
            self::Paid => 'heroicon-o-banknotes',
            self::Rejected => 'heroicon-o-x-circle',
            self::Cancelled => 'heroicon-o-minus-circle',
            self::Failed => 'heroicon-o-exclamation-circle',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'info',
            self::Processing => 'primary',
            self::Paid => 'success',
            self::Rejected => 'danger',
            self::Cancelled => 'gray',
            self::Failed => 'danger',
        };
    }
}

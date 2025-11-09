<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum KYCStatusEnum: string implements HasLabel, HasIcon, HasColor
{
    case Verified = 'verified';
    case Pending = 'pending';
    case Failed = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Verified => 'Verified',
            self::Pending => 'Pending',
            self::Failed => 'Failed',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Verified => 'heroicon-m-check-circle',
            self::Pending => 'heroicon-m-clock',
            self::Failed => 'heroicon-m-exclamation-circle',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Verified => 'success',
            self::Pending => 'warning',
            self::Failed => 'danger',
        };
    }
}

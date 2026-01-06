<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentOriginTypeEnum: string implements HasLabel, HasColor
{
    case System = 'system';
    case Admin = 'admin';
    case Gateway  = 'gateway';
    public function getLabel(): string
    {
        return match ($this) {
            self::System => 'System',
            self::Admin => 'Admin',
            self::Gateway => 'Gateway'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::System => 'success',
            self::Admin => 'success',
            self::Gateway => 'success'
        };
    }
}

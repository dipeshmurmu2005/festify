<?php

namespace App\Enums;

enum DateTypeEnum: string
{
    case BS = 'BS';
    case AD = 'AD';

    public function label(): string
    {
        return match ($this) {
            self::AD => 'AD',
            self::BS => 'BS',
        };
    }
}

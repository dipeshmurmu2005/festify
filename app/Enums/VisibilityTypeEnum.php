<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VisibilityTypeEnum: string implements HasLabel
{
    case Private = 'private';
    case Public = 'public';

    public function getLabel(): string
    {
        return match ($this) {
            self::Private => 'Private',
            self::Public => 'Public',
        };
    }
}

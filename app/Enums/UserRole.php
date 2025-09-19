<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
    case EventManager = 'event manager';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::User => 'Event Organizer',
            self::EventManager => 'Customer',
        };
    }
}

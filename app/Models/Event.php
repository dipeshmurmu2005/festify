<?php

namespace App\Models;

use App\Enums\EventSessionTypeEnum;
use App\Enums\EventStatusEnum;
use App\Enums\EventTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $guarded = [];
    protected $casts = [
        'schedule_type' => EventTypeEnum::class,
        'status' => EventStatusEnum::class,
        'session_type' => EventSessionTypeEnum::class,
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }

    public function eventSessions(): HasMany
    {
        return $this->hasMany(EventSession::class, 'event_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'event_id');
    }
}

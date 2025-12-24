<?php

namespace App\Models;

use App\Enums\EventSessionTypeEnum;
use App\Enums\EventStatusEnum;
use App\Enums\EventTypeEnum;
use App\Enums\TicketStatusEnum;
use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'schedule_type' => EventTypeEnum::class,
        'status' => EventStatusEnum::class,
        'session_type' => EventSessionTypeEnum::class,
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

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

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', EventStatusEnum::Published);
    }

    public function bookedTickets()
    {
        return $this->hasMany(BookedTicket::class, 'event_id');
    }

    public function scopeUpcoming(Builder $query)
    {
        $query
            ->whereDate('event_date', '>=', now());
    }
}

<?php

namespace App\Models;

use App\Enums\TicketCapacityTypeEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\TicketTypeEnum;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => TicketStatusEnum::class,
        'aminities' => 'array',
        'type' => TicketTypeEnum::class,
        'capacity_type' => TicketCapacityTypeEnum::class
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function totalSold($date, $session_id)
    {
        // if ($this->event->schedule_type == EventTypeEnum::AcrossDays || $this->event->schedule_type == EventTypeEnum::RecurringEvent) {
        //     $date = DateTime::createFromFormat('m/d/Y', $date);
        //     $date->setTime(0, 0, 0);
        //     return $this->bookings()->whereDate('event_date', $date)->when($session_id, function ($query) use ($session_id) {
        //         return $query->where('event_session_id', $session_id);
        //     })->sum('quantity');
        // } else {
        //     return $this->bookings()->count();
        // }
        return 0;
    }

    public function totalReservedOrBookedTickets($date, $session_id)
    {
        return $this->totalSold($date, $session_id) + $this->totalHold($date, $session_id);
    }

    public function totalHold($date, $session_id)
    {
        $date = DateTime::createFromFormat('m/d/Y', $date);
        $date->setTime(0, 0, 0);
        return $this->reservations()->whereDate('event_date', $date)->when($session_id, function ($query) use ($session_id) {
            return $query->where('event_session_id', $session_id);
        })->sum('quantity');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(BookedTicket::class, 'ticket_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(ReservedTicket::class, 'ticket_id');
    }

    public function getAvailableQuantity($date, $event_session)
    {
        if ($this->capacity_type == TicketCapacityTypeEnum::INDIVIDUAL) {
            return $this->capacity - $this->totalReservedOrBookedTickets($date, $event_session);
        } else  if ($this->capacity_type == TicketCapacityTypeEnum::SHAREDWITHSESSION) {
            $event_session =  $this->event->eventSessions()->where('id', $event_session)->first();
            return $event_session->capacity_override - $this->totalReservedOrBookedTickets($date, $event_session);
        } else {
            return $this->event->venue_capacity_override - $this->totalReservedOrBookedTickets($date, $event_session);
        }
    }
}

<?php

namespace App\Models;

use App\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    protected $casts = [];

    protected static function booted()
    {
        static::created(function ($model) {
            $tickets = ReservedTicket::where('reservation_id', $model->reservation_id)->get()->map(function ($reservedTicket) use ($model) {
                return [
                    'user_id' => $model->user_id,
                    'booking_id' => $model->id,
                    'ticket_id' => $reservedTicket->ticket_id,
                    'event_id' => $reservedTicket->event_id,
                    'event_date' => $reservedTicket->event_date,
                    'event_session_id' => $reservedTicket->event_session_id,
                    'status' => BookingStatusEnum::COMPLETED
                ];
            });
            $bookedTickets  = $model->tickets()->createMany($tickets);
        });
    }

    public function tickets()
    {
        return $this->hasMany(BookedTicket::class, 'booking_id');
    }
}

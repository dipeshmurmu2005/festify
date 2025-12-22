<?php

namespace App\Models;

use App\Enums\BookingStatusEnum;
use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Booking extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];
    protected $casts = [];

    protected static function booted()
    {
        static::created(function ($model) {
            $tickets = ReservedTicket::where('reservation_id', $model->reservation_id)->get()->map(function ($reservedTicket) use ($model) {
                return [
                    'organizer_id' => $reservedTicket->organizer_id,
                    'user_id' => $model->user_id,
                    'booking_id' => $model->id,
                    'ticket_id' => $reservedTicket->ticket_id,
                    'event_id' => $reservedTicket->event_id,
                    'event_date' => $reservedTicket->event_date,
                    'event_session_id' => $reservedTicket->event_session_id,
                    'status' => BookingStatusEnum::COMPLETED,
                    'quantity' => $reservedTicket->quantity
                ];
            });
            foreach ($tickets as $ticket) {
                for ($i = 0; $i < $ticket['quantity']; $i++) {
                    $model->tickets()->create(Arr::except($ticket, 'quantity'));
                }
            }
        });
    }

    public function tickets()
    {
        return $this->hasMany(BookedTicket::class, 'booking_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

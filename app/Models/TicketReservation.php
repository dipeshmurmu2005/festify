<?php

namespace App\Models;

use App\Enums\TicketReservationStatusEnum;
use App\Traits\BelongsToOrganizer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketReservation extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'status' => TicketReservationStatusEnum::class
    ];

    protected $appends = [
        'payment',
        'is_expired'
    ];

    public function reservedTickets(): HasMany
    {
        return $this->hasMany(ReservedTicket::class, 'reservation_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function eventSession(): BelongsTo
    {
        return $this->belongsTo(EventSession::class, 'event_session_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'reservation_id');
    }

    public function getPaymentAttribute()
    {
        return $this->payments()->first();
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'reservation_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function getIsExpiredAttribute()
    {
        return Carbon::parse($this->expires_at) < now();
    }
}

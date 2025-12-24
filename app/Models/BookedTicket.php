<?php

namespace App\Models;

use App\Traits\BarCodeGenerator;
use App\Traits\BelongsToOrganizer;
use App\Traits\TicketCodeGenerator;
use Illuminate\Database\Eloquent\Model;

class BookedTicket extends Model
{
    use BelongsToOrganizer, TicketCodeGenerator, BarCodeGenerator;

    protected $guarded = [];


    protected static function booted()
    {
        static::created(function ($model) {
            $model->ticket_code = $model->generateTicketCode($model->id);
            $model->bar_code = $model->generateBarcode($model->ticket_code);
            $model->save();
        });
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

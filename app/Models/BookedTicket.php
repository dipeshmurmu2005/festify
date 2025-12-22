<?php

namespace App\Models;

use App\Traits\BelongsToOrganizer;
use App\Traits\TicketCodeGenerator;
use Illuminate\Database\Eloquent\Model;

class BookedTicket extends Model
{
    use BelongsToOrganizer, TicketCodeGenerator;

    protected $guarded = [];


    protected static function booted()
    {
        static::created(function ($model) {
            $model->ticket_code = $model->generateTicketCode($model->id);
            $model->save();
        });
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

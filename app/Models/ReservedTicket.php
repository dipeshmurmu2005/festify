<?php

namespace App\Models;

use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservedTicket extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

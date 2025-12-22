<?php

namespace App\Models;

use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

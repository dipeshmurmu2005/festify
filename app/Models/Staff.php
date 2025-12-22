<?php

namespace App\Models;

use App\Traits\BelongsToOrganizer;
use Illuminate\Foundation\Auth\User;

class Staff extends User
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

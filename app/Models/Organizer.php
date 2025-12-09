<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Organizer extends Authenticatable
{
    protected $guarded = [];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'organizer_id');
    }
}

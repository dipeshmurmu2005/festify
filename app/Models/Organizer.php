<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Organizer extends Authenticatable
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'organizer_id');
    }

    public function settings()
    {
        return $this->hasOne(OrganizerSetting::class, 'organizer_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'organizer_id');
    }
}

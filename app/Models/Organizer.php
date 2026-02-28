<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organizer extends Authenticatable
{
    use HasFactory;

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

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class, 'organizer_id');
    }
}

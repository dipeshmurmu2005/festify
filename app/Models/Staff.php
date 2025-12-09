<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Staff extends User
{
    protected $guarded = [];

    protected $casts = [
        'password' => 'hashed'
    ];
}

<?php

namespace App\Models;

use App\Enums\UserRole as EnumsUserRole;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $guarded = [];

    protected $casts = [
        'role' => EnumsUserRole::class
    ];
}

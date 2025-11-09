<?php

namespace App\Models;

use App\Enums\LinkStatus;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => LinkStatus::class
    ];
}

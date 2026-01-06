<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformAccount extends Model
{
    public function platformTransactions()
    {
        return $this->morphMany(PlatformTransaction::class, 'beneficiary');
    }
}

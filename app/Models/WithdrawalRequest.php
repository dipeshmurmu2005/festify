<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\WithdrawalRequestEnum;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => WithdrawalRequestEnum::class,
        'payment_method' => PaymentMethodEnum::class,
        'payment_details' => 'array'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }
}

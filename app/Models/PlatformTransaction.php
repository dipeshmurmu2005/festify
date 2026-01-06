<?php

namespace App\Models;

use App\Actions\WalletTransactionAction;
use App\Enums\PlatformTransactionSourceEnum;
use App\Enums\PlatformTransactionStatusEnum;
use App\Enums\PlatformTransactionTypeEnum;
use App\Enums\TransactionPurposeEnum;
use Illuminate\Database\Eloquent\Model;

class PlatformTransaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => PlatformTransactionTypeEnum::class,
        'purpose' => TransactionPurposeEnum::class,
        'status' => PlatformTransactionStatusEnum::class,
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function referenceable()
    {
        return $this->morphTo();
    }

    public function initiator()
    {
        return $this->morphTo();
    }

    public function beneficiary()
    {
        return $this->morphTo();
    }
}

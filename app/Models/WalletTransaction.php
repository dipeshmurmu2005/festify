<?php

namespace App\Models;

use App\Enums\WalletTransactionSourceAndDestinationTypeEnum;
use App\Enums\WalletTransactionTypeEnum;
use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use BelongsToOrganizer;
    protected $guarded = [];
    protected $casts = [
        'type' => WalletTransactionTypeEnum::class,
        'source_type' => WalletTransactionSourceAndDestinationTypeEnum::class,
        'destination_type' => WalletTransactionSourceAndDestinationTypeEnum::class,
    ];
    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }
}

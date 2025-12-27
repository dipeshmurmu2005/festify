<?php

namespace App\Models;

use App\Actions\WalletTransactionAction;
use App\Enums\PlatformTransactionSourceEnum;
use App\Enums\PlatformTransactionStatusEnum;
use App\Enums\PlatformTransactionTypeEnum;
use Illuminate\Database\Eloquent\Model;

class PlatformTransaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => PlatformTransactionTypeEnum::class,
        'source' => PlatformTransactionSourceEnum::class,
        'status' => PlatformTransactionStatusEnum::class,
        'meta' => 'array',
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->organizer_id && $model->type == PlatformTransactionTypeEnum::CREDIT && $model->source == PlatformTransactionSourceEnum::TICKET_PURCHASE) {
                $walletAction = new WalletTransactionAction();
                $walletAction->credit($model->organizer_id, $model->amount, 'Ticket Payment');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}

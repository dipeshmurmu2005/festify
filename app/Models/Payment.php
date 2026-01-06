<?php

namespace App\Models;

use App\Actions\PlatformTransactionAction;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentOriginTypeEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\PlatformTransactionSourceEnum;
use App\Enums\TransactionPurposeEnum;
use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'origin' => PaymentOriginTypeEnum::class,
        'payment_method' => PaymentMethodEnum::class
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->status == PaymentStatusEnum::Verified) {
                $platformTransaction = new PlatformTransactionAction();
                $platformTransactionData = [
                    'beneficiary_type' => $model->beneficiary_type,
                    'beneficiary_id' => $model->beneficiary_id,
                    'purpose' => TransactionPurposeEnum::TICKET_PURCHASE,
                    'origin' => $model->origin,
                    'amount' => $model->amount,
                    'referenceable_type' =>  $model->referenceable_type,
                    'referenceable_id' => $model->referenceable_id,
                    'initiator_type' => User::class,
                    'initiator_id' => $model->user_id,
                    'organizer_id' => $model->organizer_id,
                ];
                $platformTransaction->credit($platformTransactionData);
            }
        });
    }


    public function reservation()
    {
        return $this->belongsTo(TicketReservation::class, 'reservation_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function beneficiary()
    {
        return $this->morphTo();
    }
}

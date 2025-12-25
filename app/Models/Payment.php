<?php

namespace App\Models;

use App\Actions\PlatformTransactionAction;
use App\Actions\WalletTransactionAction;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentVerificationStatus;
use App\Enums\PlatformTransactionSourceEnum;
use App\Traits\BelongsToOrganizer;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'payment_method' => PaymentMethodEnum::class
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->status == PaymentStatusEnum::Verified) {
                $platformTransaction = new PlatformTransactionAction();
                $platformTransaction->credit($model->organizer->id, $model->user_id, $model->amount, PlatformTransactionSourceEnum::TICKET_PURCHASE, 'Ticket Payment');
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
}

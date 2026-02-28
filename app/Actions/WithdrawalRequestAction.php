<?php

namespace App\Actions;

use App\Enums\PaymentMethodEnum;
use App\Models\WithdrawalRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WithdrawalRequestAction
{

    private $organizer;
    private $event;
    private $secret_key;
    private $platform_fee;
    private $processing_fee;

    public function __construct(Model $event)
    {
        $this->organizer = auth()->user()->organizer;
        $this->event = $event;
        $this->secret_key = env('APP_KEY');

        $this->platform_fee = 10;
        $this->processing_fee = 5;
    }
    public function createRequest($data)
    {
        $request = WithdrawalRequest::create([
            'organizer_id' => $this->organizer->id,
            'event_id' => $this->event->id,
            'reference_no' => 'W-' . Str::uuid(),
            'amount' => $data['amount'],
            'net_amount' => $this->getNetAmount($data['amount']),
            'available_balance_at_request' => $this->organizer->wallet->balance,
            'currency' => "NPR",
            'payment_method' => PaymentMethodEnum::Bank,
            'payment_details' => $data['payment_details'],
        ]);
        return $request;
    }

    private function getNetAmount($amount)
    {
        return $this->platform_fee + $this->processing_fee + $amount;
    }
}

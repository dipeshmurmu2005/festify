<?php

namespace App\Actions;

use App\Enums\PaymentMethodEnum;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Str;

class WithdrawalRequestAction
{

    private $organizer;
    private $platform_fee;
    private $processing_fee;

    public function __construct()
    {
        $this->organizer = auth()->user()->organizer;
        $this->platform_fee = 10;
        $this->processing_fee = 5;
    }
    public function createRequest($data)
    {
        if ($data['amount'] >= 5000) {
            $request = WithdrawalRequest::create([
                'organizer_id' => $this->organizer->id,
                'reference_no' => 'W-' . Str::uuid(),
                'amount' => $data['amount'],
                'net_amount' => $this->getNetAmount($data['amount']),
                'available_balance_at_request' => $this->organizer->wallet->balance,
                'currency' => "NPR",
                'payment_method' => PaymentMethodEnum::Bank,
                'payment_details' => $data['payment_details'],
            ]);
            return $request;
        } else {
            return false;
        }
    }

    private function getNetAmount($amount)
    {
        return $amount - $this->platform_fee + $this->processing_fee;
    }
}

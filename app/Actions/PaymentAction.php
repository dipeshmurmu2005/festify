<?php

namespace App\Actions;

use App\Models\TicketReservation;
use Illuminate\Support\Facades\Http;

class PaymentAction
{
    protected $product_code;
    protected $secret_key;
    protected $base_url;

    public function __construct()
    {
        $this->product_code = config('services.esewa.product_code');
        $this->secret_key = config('services.esewa.secret_key');
        $this->base_url = config('services.esewa.base_url');
    }

    public function initiatePayment($user_id, $reservation_id)
    {
        $reservation = TicketReservation::find($reservation_id);
        $transaction_uuid = $reservation->reservation_code;
        $total_amount = $reservation->total_amount;
        $dataToSign = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=EPAYTEST";
        $s = hash_hmac('sha256', $dataToSign, $this->secret_key, true);

        $signature = base64_encode($s);
        $params = [
            "amount" => $reservation->total_amount,
            "failure_url" => "https://developer.esewa.com.np/failure",
            "product_delivery_charge" => "0",
            "product_service_charge" => "0",
            "product_code" => "EPAYTEST",
            "signature" => $signature,
            "signed_field_names" => "total_amount,transaction_uuid,product_code",
            "success_url" => route('payment.success'),
            "tax_amount" => "0",
            "total_amount" => $reservation->total_amount,
            "transaction_uuid" => $transaction_uuid
        ];

        return $params;
    }
}

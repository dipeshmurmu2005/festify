<?php

namespace App\Livewire;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use App\Models\Booking;
use App\Models\TicketReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PaymentSuccessWire extends Component
{
    public function mount(Request $request)
    {
        $data = $request->get('data');
        if ($data) {
            $response = json_decode(base64_decode($data), true);
            if ($response) {
                $this->checkPayment($response['product_code'], $response['total_amount'], $response['transaction_uuid']);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.payment-success-wire');
    }

    private function checkPayment($product_code, $total_amount, $transaction_uuid)
    {
        $params = [
            'product_code' => $product_code,
            'total_amount' => $total_amount,
            'transaction_uuid' => $transaction_uuid
        ];
        $response = Http::get("https://rc.esewa.com.np/api/epay/transaction/status", $params);
        $data = json_decode($response->body(), true);
        if ($data['status'] == 'COMPLETE') {
            $reservation = TicketReservation::where('reservation_code', $transaction_uuid)->first();
            if ($reservation && $reservation->status == TicketReservationStatusEnum::PAYMENT_INITIATED) {
                $payment = $reservation->payments()->create([
                    'user_id' => auth()->user()->id,
                    'organizer_id' => $reservation->organizer_id,
                    'reservation_id' => $reservation->id,
                    'event_id' => $reservation->event_id,
                    'event_session_id' => $reservation->event_session_id,
                    'amount' => $reservation->total_amount,
                    'transaction_uuid' => $data['transaction_uuid'],
                    'ref_id' => $data['ref_id'],
                    'payment_method' =>  PaymentMethodEnum::Esewa,
                    'status' => PaymentStatusEnum::Verified
                ]);
                $reservation->status = TicketReservationStatusEnum::PAYMENT_DONE;
                $reservation->save();
                if ($payment) {
                    $booking = Booking::create([
                        'organizer_id' => $reservation->organizer_id,
                        'user_id' => auth()->user()->id,
                        'event_id' => $reservation->event_id,
                        'reservation_id' => $reservation->id
                    ]);
                }
            } else {
                if ($reservation) {
                    $this->redirect(route('view.reservation', ['reservation_id' => $reservation->id]), navigate: true);
                } else {
                    abort(404);
                }
            }
        }
    }
}

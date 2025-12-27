<?php

namespace App\Livewire;

use App\Actions\BookingAction;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use App\Models\Booking;
use App\Models\TicketReservation;
use App\Traits\BookingCodeGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PaymentSuccessWire extends Component
{
    use BookingCodeGenerator;

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
            $reservation = TicketReservation::where('transaction_uuid', $transaction_uuid)->first();
            if ($reservation && $reservation->status == TicketReservationStatusEnum::PAYMENT_INITIATED) {
                $bookingAction = new BookingAction();
                $bookingAction->initiateBooking($reservation->id, $data);
                $this->redirect(route('view.reservation', ['reservation_id' => $reservation->id]), navigate: true);
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

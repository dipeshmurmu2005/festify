<?php

namespace App\Livewire;

use App\Actions\PaymentAction;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use Livewire\Attributes\Url;
use Livewire\Component;

class Reservation extends Component
{
    #[Url('reservation_id')]
    public $reservation_id;

    public $reservation;

    public $token;

    public $payer_id;

    public $payment_params;

    public function mount()
    {
        $user = auth()->user();
        $this->reservation = $user->reservations()->find($this->reservation_id);
        if (!$this->reservation) {
            abort(404);
        }
    }

    protected $rules = [
        'token' => 'required|string',
        'payer_id' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.reservation');
    }

    public function requestPayment()
    {
        $this->validate();
        if (!$this->reservation->payment) {
            $this->createPayment();
        } else {
            if ($this->reservation->payment->status == PaymentStatusEnum::Failed) {
                $this->createPayment();
            }
        }
    }

    protected function createPayment()
    {

        $payment = new PaymentAction();
        $this->payment_params = $payment->initiatePayment(auth()->user()->id, $this->reservation->id);
        $this->reservation->status = TicketReservationStatusEnum::PAYMENT_INITIATED;
        $this->reservation->save();
        $this->dispatch('redirect-to-payment');
        // $payment = $this->reservation->payments()->create([
        //     'user_id' => auth()->user()->id,
        //     'organizer_id' => $this->reservation->organizer_id,
        //     'reservation_id' => $this->reservation_id,
        //     'event_id' => $this->reservation->event_id,
        //     'event_session_id' => $this->reservation->event_session_id,
        //     'amount' => $this->reservation->total_amount,
        //     'token' => $this->token,
        //     'payer_id' => $this->payer_id,
        //     'payment_method' =>  PaymentMethodEnum::Esewa,
        // ]);
        // return $payment;
    }
}

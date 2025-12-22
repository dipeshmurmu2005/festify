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

    public $payment_params;

    public function mount()
    {
        $user = auth()->user();
        $this->reservation = $user->reservations()->find($this->reservation_id);
        if (!$this->reservation) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.reservation');
    }

    public function requestPayment()
    {
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
        $this->reservation->transaction_uuid = $this->payment_params['transaction_uuid'];
        $this->reservation->save();
        $this->dispatch('redirect-to-payment');
    }
}

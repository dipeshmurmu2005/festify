<?php

namespace App\Livewire;

use App\Actions\BookingAction;
use App\Actions\PaymentAction;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentOriginTypeEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use App\Models\Organizer;
use App\Models\TicketReservation;
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

        if ($this->reservation->status == TicketReservationStatusEnum::ACTIVE || $this->reservation->status == TicketReservationStatusEnum::PAYMENT_INITIATED) {
            if ($this->reservation->total_amount > 0) {
                $payment = new PaymentAction();
                $this->payment_params = $payment->initiatePayment(auth()->user()->id, $this->reservation->id);
                $this->reservation->status = TicketReservationStatusEnum::PAYMENT_INITIATED;
                $this->reservation->transaction_uuid = $this->payment_params['transaction_uuid'];
                $this->reservation->save();
                $this->dispatch('redirect-to-payment');
            } else {
                $bookingAction = new BookingAction();
                $bookingAction->initiateBooking($this->reservation->id);
                $this->reservation = auth()->user()->reservations()->find($this->reservation_id);
                $this->reservation->payments()->create([
                    'organizer_id' => $this->reservation->organizer_id,
                    'user_id' => auth()->user()->id,
                    'event_id' => $this->reservation->event_id,
                    'amount' => $this->reservation->total_amount,
                    'beneficiary_type' => Organizer::class,
                    'beneficiary_id' => $this->reservation->organizer_id,
                    'referenceable_type' => TicketReservation::class,
                    'referenceable_id' => $this->reservation->id,
                    'origin' => PaymentOriginTypeEnum::System,
                    'status' => PaymentStatusEnum::Verified
                ]);
            }
        }
    }

    public function canInitiatePayment()
    {
        if ($this->reservation->status == TicketReservationStatusEnum::ACTIVE || $this->reservation->status == TicketReservationStatusEnum::PAYMENT_INITIATED) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelReservation()
    {
        $this->reservation->status = TicketReservationStatusEnum::CANCELLED;
        $this->reservation->save();
    }
}

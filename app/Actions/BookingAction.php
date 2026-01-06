<?php

namespace App\Actions;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentOriginTypeEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use App\Models\Booking;
use App\Models\PlatformAccount;
use App\Models\TicketReservation;
use App\Traits\BookingCodeGenerator;

class BookingAction
{
    use BookingCodeGenerator;
    private $booking;

    public function initiateBooking($reservation_id, $transaction_data = null)
    {
        $reservation = TicketReservation::find($reservation_id);
        if ($reservation->total_amount > 0) {
            if ($transaction_data) {
                $this->createPayment($reservation, $transaction_data);
                $this->createBooking($reservation);
            }
        } else {
            $this->createBooking($reservation);
            $reservation->status = TicketReservationStatusEnum::PAYMENT_DONE;
            $reservation->save();
        }
    }

    private function createBooking($reservation)
    {
        $booking = Booking::create([
            'organizer_id' => $reservation->organizer_id,
            'user_id' => auth()->user()->id,
            'event_id' => $reservation->event_id,
            'reservation_id' => $reservation->id
        ]);
        $booking->booking_code = $this->generateBookingCode($booking->id);
        $booking->save();
    }

    private function createPayment($reservation, $transaction_data)
    {
        $payment = $reservation->payments()->create([
            'user_id' => auth()->user()->id,
            'organizer_id' => $reservation->organizer_id,
            'reservation_id' => $reservation->id,
            'event_id' => $reservation->event_id,
            'event_session_id' => $reservation->event_session_id,
            'amount' => $reservation->total_amount,
            'transaction_uuid' => $transaction_data['transaction_uuid'],
            'ref_id' => $transaction_data['ref_id'],
            'payment_method' =>  PaymentMethodEnum::Esewa,
            'status' => PaymentStatusEnum::Verified,
            'beneficiary_type' => PlatformAccount::class,
            'beneficiary_id' => PlatformAccount::first()->id,
            'origin' => $reservation->total_amount > 0 ? PaymentOriginTypeEnum::Gateway : PaymentOriginTypeEnum::System,
            'referenceable_type' =>  TicketReservation::class,
            'referenceable_id' => $reservation->id,
        ]);
        $reservation->status = TicketReservationStatusEnum::PAYMENT_DONE;
        $reservation->save();
    }
}

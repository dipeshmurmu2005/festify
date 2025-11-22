<?php

namespace App\Actions;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Booking;
use App\Models\Reservation;

class BookingAction
{
    private $booking;

    public function book($reservation_id)
    {
        // dd($ordered_tickets);
    }

    public function createBooking($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        $booking = Booking::create([
            'reservation_id' => $reservation_id,
            'event_id' => $reservation->event_id,
            'user_id' => $reservation->user_id,
            'payment_status' => PaymentStatusEnum::Pending,
            'booking_status' => BookingStatusEnum::PENDING
        ]);
    }
}

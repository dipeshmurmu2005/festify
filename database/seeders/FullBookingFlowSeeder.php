<?php

namespace Database\Seeders;

use App\Enums\PaymentStatusEnum;
use App\Enums\TicketReservationStatusEnum;
use App\Models\{
    Event,
    Ticket,
    TicketReservation,
    Booking,
    Payment,
    User
};
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FullBookingFlowSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::published()
            ->whereHas('tickets', fn($q) => $q->where('status', 'active'))
            ->with(['tickets' => fn($q) => $q->where('status', 'active')])
            ->get();

        if ($events->isEmpty()) {
            $this->command->warn('No published events with active tickets.');
            return;
        }

        $user = User::first();
        $now  = Carbon::now();

        for ($i = 1; $i <= 200; $i++) {

            DB::beginTransaction();

            try {
                $event     = $events->random();
                $organizer = $event->organizer;

                /** Reservation status distribution */
                $status = match (true) {
                    $i <= 10 => 'active',
                    $i <= 18 => TicketReservationStatusEnum::PAYMENT_INITIATED->value,
                    $i <= 24 => 'expired',
                    default  => 'payment done', // booking created
                };

                $expiresAt = match ($status) {
                    'active' =>
                    $now->copy()->addMinutes(rand(5, 20)),

                    TicketReservationStatusEnum::PAYMENT_INITIATED->value =>
                    $now->copy()->subMinutes(rand(2, 10)),

                    'expired' =>
                    $now->copy()->subMinutes(rand(30, 180)),

                    default =>
                    $now->copy()->addMinutes(5),
                };

                /** Reservation */
                $reservation = TicketReservation::create([
                    'organizer_id'     => $organizer->id,
                    'user_id'          => $user->id,
                    'guest_user_info'  => null,

                    'reservation_code' => 'RSV-' . strtoupper(Str::random(10)),
                    'transaction_uuid' => (string) Str::uuid(),

                    'event_id'         => $event->id,
                    'event_session_id' => null,

                    'status'           => $status,
                    'expires_at'       => $expiresAt,
                    'total_amount'     => 0,
                ]);

                /** Reserved tickets */
                $totalAmount = 0;
                $reservedTickets = [];

                $tickets = $event->tickets->random(rand(1, min(3, $event->tickets->count())));

                foreach ($tickets as $ticket) {
                    $quantity = rand(1, 4);
                    $price    = $ticket->base_price;

                    DB::table('reserved_tickets')->insert([
                        'organizer_id'     => $organizer->id,
                        'reservation_id'   => $reservation->id,
                        'ticket_id'        => $ticket->id,
                        'event_id'         => $event->id,
                        'event_session_id' => null,
                        'event_date'       => $event->event_date,
                        'base_price'       => $price,
                        'quantity'         => $quantity,
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ]);

                    $reservedTickets[] = compact('ticket', 'quantity');
                    $totalAmount += $price * $quantity;
                }

                $reservation->update([
                    'total_amount' => $totalAmount,
                ]);

                /** Only completed → payment, booking, wallet */
                if ($status === 'payment done') {

                    /** Payment */
                    $paymentId = Payment::create([
                        'organizer_id'     => $organizer->id,
                        'user_id'          => $user->id,
                        'reservation_id'   => $reservation->id,
                        'event_id'         => $event->id,
                        'event_session_id' => null,
                        'amount'           => $totalAmount,
                        'payment_method'   => 'esewa',
                        'transaction_uuid' => (string) Str::uuid(),
                        'ref_id'           => 'PAY-' . strtoupper(Str::random(8)),
                        'status'           => PaymentStatusEnum::Verified,
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ]);

                    /** Booking */
                    $booking = Booking::create([
                        'organizer_id'   => $organizer->id,
                        'booking_code'   => 'BK-' . strtoupper(Str::random(10)),
                        'user_id'        => $user->id,
                        'event_id'       => $event->id,
                        'reservation_id' => $reservation->id,
                    ]);

                    // /** Wallet transaction (credit organizer) */
                    // DB::table('wallet_transactions')->insert([
                    //     'wallet_id'    => $organizer->wallet->id,
                    //     'organizer_id' => $organizer->id,
                    //     'type'         => 'credit',
                    //     'amount'       => $totalAmount,
                    //     'description'  => 'Ticket booking payment',
                    //     'created_at'   => $now,
                    //     'updated_at'   => $now,
                    // ]);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }
}

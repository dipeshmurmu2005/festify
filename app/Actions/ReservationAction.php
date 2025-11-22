<?php

namespace App\Actions;

use App\Models\Event;
use App\Models\EventSession;
use App\Models\Ticket;
use App\Models\TicketReservation;
use App\Models\User;
use App\Traits\ReservationCodeGenerator;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\info;
use function Symfony\Component\Clock\now;

class ReservationAction
{
    use ReservationCodeGenerator;

    private $reservation;

    private $ordered_tickets;

    private $eventSession;

    private $event;

    private $user;

    private $total_amount;

    private function initialize($user_id, $event_id, $session_id)
    {
        $this->user = User::find($user_id);
        if ($session_id) {
            $this->eventSession = EventSession::find($session_id);
        }
        $this->event = Event::find($event_id);
    }

    public function create($data)
    {
        $this->initialize($data['user_id'], $data['event_id'], $data['session_id']);
        $this->ordered_tickets = collect($data['ordered_tickets']);
        $event_date = DateTime::createFromFormat('m/d/Y', $data['event_date']);
        $event_date->setTime(0, 0, 0);
        try {
            DB::beginTransaction();
            $reservation = TicketReservation::create([
                'event_id' => $this->event->id,
                'event_session_id' => $this->eventSession ? $this->eventSession->id : null,
                'user_id' => $this->user->id,
                'expires_at' => Carbon::now()->addMinute(10),
            ]);

            $reservation_code = $this->generateReservationCode($reservation->id);

            $reservation->reservation_code = $reservation_code;

            $formattedOrderedTickets = $this->ordered_tickets->map(function ($ordered_ticket) use ($reservation, $event_date) {
                $ticket = Ticket::find($ordered_ticket['id']);
                $this->total_amount += $ticket->base_price * $ordered_ticket['quantity'];
                return [
                    'reservation_id' => $reservation->id,
                    'event_date' => $event_date,
                    'ticket_id' => $ticket->id,
                    'event_session_id' => $this->eventSession ? $this->eventSession->id : null,
                    'base_price' => $ticket->base_price,
                    'quantity' => $ordered_ticket['quantity'],
                ];
            });

            $reservation->total_amount = $this->total_amount;
            $reservation->save();

            $reservation->reservedTickets()->createMany($formattedOrderedTickets);
            DB::commit();
            return $reservation;
        } catch (\Throwable $th) {
            info($th);
        }
    }
}

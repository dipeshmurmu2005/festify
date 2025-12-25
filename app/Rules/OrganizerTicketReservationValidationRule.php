<?php

namespace App\Rules;

use App\Enums\TicketCapacityTypeEnum;
use App\Models\Ticket;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OrganizerTicketReservationValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $sessionId;

    protected $date;

    protected $ticket_id;

    public function __construct($date, $ticket_id, $sessionId)
    {
        $this->date  = $date;
        $this->ticket_id = $ticket_id;
        $this->sessionId = $sessionId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ticket = Ticket::find($this->ticket_id);
        $booked_quantity = $value;
        $available_quantity = 0;

        if ($ticket) {
            if ($ticket->capacity_type == TicketCapacityTypeEnum::INDIVIDUAL) {
                $available_quantity = $ticket->capacity - $ticket->totalReservedOrBookedTickets($this->date, $this->sessionId);
            } else  if ($ticket->capacity_type == TicketCapacityTypeEnum::SHAREDWITHSESSION) {
                $event_session =  $ticket->event->eventSessions()->where('id', $this->sessionId)->first();
                $available_quantity = $event_session->capacity_override - $ticket->totalReservedOrBookedTickets($this->date, $this->sessionId);
            } else {
                $available_quantity = $ticket->event->venue_capacity_override - $ticket->totalReservedOrBookedTickets($this->date, $this->sessionId);
            }

            if ($available_quantity <= 0 || $booked_quantity > $available_quantity) {
                $fail("The {$ticket->title} Ticket Quantity is invalid. The quantity must be <= {$available_quantity}");
            }
        } else {
            $fail("Unknown Ticket");
        }
    }
}

<?php

namespace App\Livewire;

use App\Actions\ReservationAction;
use App\Enums\EventStatusEnum;
use App\Enums\TicketCapacityTypeEnum;
use App\Models\Event;
use App\Rules\TicketBookingValidationRule;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class EventViewWire extends Component
{
    public $event;

    public $date;

    public $event_session;

    public $event_sessions;

    public $booked_tickets = [];

    #[Locked]
    public $has_session = false;

    public $tickets;

    public function rules()
    {
        return [
            'date' => 'required',
            'event_session' => 'required_if:has_session,true'
        ];
    }

    public function mount(Event $event)
    {
        $this->event = $event;
        if ($this->event->status == EventStatusEnum::Published) {
            $this->date = Carbon::parse($this->event->event_date)->format('m/d/Y');
            if ($this->event->eventSessions->count() > 0) {
                $this->has_session = true;
                $this->event_session = $this->event->eventSessions->first()->id;
            }

            $this->getAvailableTickets();
        } else {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.event-view-wire');
    }

    public function book()
    {
        $this->validate();
    }

    public function updatedEventSession()
    {
        $this->getAvailableTickets();
    }

    public function updatedDate($value)
    {
        $this->getAvailableTickets();
    }

    #[On('refresh-tickets')]
    public function getAvailableTickets()
    {
        if ($this->date) {
            $this->tickets = $this->event->tickets->filter(function ($ticket) {
                return $ticket->verifyTicketSaleDate();
            })->map(function ($ticket) {
                $availableQty = $this->getAvailableTicketQuantity($ticket);
                return [
                    'id' => $ticket->id,
                    'title' => $ticket->title,
                    'available' => $availableQty,
                    'price' => $ticket->base_price + $this->attachPriceAdjustment($ticket),
                    'limit' => $availableQty >= 10 ? 10 : $availableQty
                ];
            });
        } else {
            $this->tickets = collect([]);
        }
        $this->dispatch('refresh-booked_tickets');
    }

    public function getAvailableTicketQuantity($ticket)
    {
        if ($ticket->capacity_type == TicketCapacityTypeEnum::INDIVIDUAL) {
            return $ticket->capacity - $ticket->totalReservedOrBookedTickets($this->date, $this->event_session);
        } else  if ($ticket->capacity_type == TicketCapacityTypeEnum::SHAREDWITHSESSION) {
            $event_session =  $this->event->eventSessions()->where('id', $this->event_session)->first();
            return $event_session->capacity_override - $ticket->totalReservedOrBookedTickets($this->date, $this->event_session);
        } else {
            return $ticket->event->venue_capacity_override - $ticket->totalReservedOrBookedTickets($this->date, $this->event_session);
        }
    }

    public function attachPriceAdjustment($ticket)
    {
        if ($ticket->capacity_type == TicketCapacityTypeEnum::SHAREDWITHSESSION) {
            $event_session =  $this->event->eventSessions()->where('id', $this->event_session)->first();
            return $event_session->ticket_adjustment;
        } else {
            return 0;
        }
    }

    #[On('reserve-tickets')]
    public function bookTickets()
    {
        $this->validate([
            'booked_tickets' => 'required|array',
            'booked_tickets.*' => [new TicketBookingValidationRule($this->date, $this->event_session)]
        ], [
            'booked_tickets.required' => "Please add ticket to continue."
        ]);
        $reservationAction = new ReservationAction();
        $userId = auth()->user()->id;

        $data = [
            'ordered_tickets' => $this->booked_tickets,
            'user_id' => $userId,
            'event_id' => $this->event->id,
            'event_date' => $this->date,
            'session_id' => $this->event_session
        ];
        $reservation = $reservationAction->create($data);
        if ($reservation) {
            $this->dispatch('ticket-reserved');
        }
    }
}

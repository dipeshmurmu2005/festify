<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class TrendingEventsWire extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::withMin('tickets', 'base_price')
            ->withMax('tickets', 'base_price')
            ->withCount('bookedTickets')->orderByDesc('booked_tickets_count')->take(10)->get();
    }

    public function render()
    {
        return view('livewire.trending-events-wire');
    }
}

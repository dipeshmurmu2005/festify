<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class TrendingEventsWire extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::published()->withMin('tickets', 'base_price')
            ->withMax('tickets', 'base_price')
            ->whereHas('tickets', function ($q) {
                $q->whereDate('sales_starts_at', '<=', now());
            })
            ->withCount(['tickets as active_tickets_count' => function ($q) {
                $q->where('status', 'active')->whereDate('sales_starts_at', '<=', now());
            }])
            ->withCount('bookedTickets')->orderByDesc('booked_tickets_count')->take(10)->get();
    }

    public function render()
    {
        return view('livewire.trending-events-wire');
    }
}

<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;

class HomeWire extends Component
{
    public $latest_events;

    public $categories;

    public function mount()
    {
        $this->latest_events = Event::published()->withMin('tickets', 'base_price')
            ->withMax('tickets', 'base_price')
            ->whereHas('tickets', function ($q) {
                $q->whereDate('sales_starts_at', '<=', now());
            })
            ->withCount(['tickets as active_tickets_count' => function ($q) {
                $q->where('status', 'active')->whereDate('sales_starts_at', '<=', now());
            }])
            ->get();

        $this->categories = EventCategory::all();
    }
    public function render()
    {
        return view('livewire.home-wire');
    }
}

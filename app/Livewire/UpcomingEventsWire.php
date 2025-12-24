<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class UpcomingEventsWire extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::latest()->upcoming()->take(10)->get();
    }

    public function render()
    {
        return view('livewire.upcoming-events-wire');
    }
}

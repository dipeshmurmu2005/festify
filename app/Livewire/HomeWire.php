<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;

class HomeWire extends Component
{
    public $featured_events;

    public $categories;

    public function mount()
    {
        $this->featured_events = Event::latest()->take(10)->get();

        $this->categories = EventCategory::all();
    }
    public function render()
    {
        return view('livewire.home-wire');
    }
}

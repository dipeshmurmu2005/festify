<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;

class HomeWire extends Component
{
    public $events;

    public $categories;

    public function mount()
    {
        $this->events = Event::latest()->get();

        $this->categories = EventCategory::all();
    }
    public function render()
    {
        return view('livewire.home-wire');
    }
}

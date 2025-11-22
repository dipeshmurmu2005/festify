<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class HomeWire extends Component
{
    public $events;
    public function mount()
    {
        $this->events = Event::latest()->get();
    }
    public function render()
    {
        return view('livewire.home-wire');
    }
}

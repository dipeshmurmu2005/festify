<?php

namespace App\Livewire;

use App\Models\EventCategory;
use Livewire\Component;

class NavWire extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = EventCategory::all();
    }
    public function render()
    {
        return view('livewire.nav-wire');
    }
}

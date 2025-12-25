<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-tickets', ['title' => 'My Tickets', 'description' => 'Manage your tickets seamlessly'])]
class UserBookings extends Component
{
    public $bookings;

    public function mount()
    {
        $this->bookings = auth()->user()->bookings()->with('event')->withCount('tickets')->latest()->get();
    }

    public function render()
    {
        return view('livewire.user-bookings');
    }
}

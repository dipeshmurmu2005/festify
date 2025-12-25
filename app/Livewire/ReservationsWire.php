<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-tickets', ['title' => 'My Reservations', 'description' => 'Manage your upcoming events, complete reservations, and view your history '])]
class ReservationsWire extends Component
{
    public $reservations;

    public function mount()
    {
        $this->reservations = auth()->user()->reservations()->with('event')->withSum('reservedTickets', 'quantity')->latest()->get();
    }

    public function render()
    {
        return view('livewire.reservations-wire');
    }
}

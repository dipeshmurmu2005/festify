<?php

namespace App\Livewire;

use App\Enums\KYCStatusEnum;
use Livewire\Component;

class OrganizerWire extends Component
{

    public function mount()
    {
        if (auth()->user() && auth()->user()->isOrganizer()) {
            $this->redirectRoute('filament.organizer.pages.dashboard', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.organizer-wire');
    }

    public function getStarted()
    {
        $this->redirectRoute('register', navigate: true);
    }
}

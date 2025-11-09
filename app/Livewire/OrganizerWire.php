<?php

namespace App\Livewire;

use App\Enums\KYCStatusEnum;
use Livewire\Component;

class OrganizerWire extends Component
{
    public $kyc_verification_help = false;

    public function render()
    {
        return view('livewire.organizer-wire');
    }

    public function getStarted()
    {
        if (auth()->user()) {
            if (auth()->user()?->kyc?->status == KYCStatusEnum::Verified) {
                dd('hello');
            } else {
                $this->kyc_verification_help = true;
            }
        }
    }
}

<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ComingSoon extends Component
{
    #[Layout('components.layouts.comingsoon')]
    public function render()
    {
        return view('livewire.coming-soon');
    }
}

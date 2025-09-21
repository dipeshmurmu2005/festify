<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.settings')]
class UserProfileSetting extends Component
{
    public $name;

    public $userprofile = false;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }
    public function render()
    {
        return view('livewire.user-profile-setting');
    }

    public function updateDisplayName()
    {
        if ($this->name) {
            $user = User::find(auth()->user()->id);
            $user->name = $this->name;
            $user->save();
            $this->userprofile = false;
        } else {
            $this->addError('name', 'Please provide name');
        }
    }
}

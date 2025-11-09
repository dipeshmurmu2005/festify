<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.settings')]
class SecuritySettingWire extends Component
{
    public $enable_password_change = false;

    public $current_password;

    public $password;

    public $password_confirmation;

    public function rules()
    {
        return [
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ];
    }

    public function render()
    {
        return view('livewire.security-setting-wire');
    }

    public function updatePassword()
    {
        $this->validate();
        if (Hash::check($this->current_password, auth()->user()->password)) {
            $this->enable_password_change = false;
            $user = auth()->user();
            $user->password = $this->password;
            $user->save();
            $this->enable_password_change = false;
            return true;
        } else {
            return $this->addError('current_password', 'Invalid Password');
        }
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginWire extends Component
{
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function render()
    {
        return view('livewire.login-wire');
    }

    public function login()
    {
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else if (Auth::guard('organizer')->attempt($credentials)) {
            return redirect()->route('filament.organizer.pages.dashboard');
        }
        $this->addError('email', 'Invalid email or password.');
    }
}

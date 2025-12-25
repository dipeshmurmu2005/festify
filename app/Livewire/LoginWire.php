<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginWire extends Component
{
    public $email;
    public $password;

    public function mount()
    {
        if (auth()->user()) {
            return redirect()->route('home');
        }
    }

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
        }
        $this->addError('email', 'Invalid email or password.');
    }
}

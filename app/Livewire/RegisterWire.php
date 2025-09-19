<?php

namespace App\Livewire;

use App\Mail\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class RegisterWire extends Component
{
    public $email;

    public $fullname;

    public function render()
    {
        return view('livewire.register-wire');
    }

    public function handleFirstStep()
    {
        $verificationUrl = URL::temporarySignedRoute('register.verify', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $verificationUrl));
    }
}

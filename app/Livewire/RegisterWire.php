<?php

namespace App\Livewire;

use App\Mail\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class RegisterWire extends Component
{
    public $email;

    public $fullname;

    private $verificationUrl;

    #[Locked]
    public $second_step;

    public function mount()
    {
        session()->forget(['sent_email']);
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|string'
        ];
    }

    public function render()
    {
        return view('livewire.register-wire');
    }

    public function handleFirstStep()
    {
        $this->validate();
        $this->second_step = true;
    }

    public function handleSecondStep()
    {
        $this->validate();
        $this->verificationUrl =  URL::temporarySignedRoute('register.verify', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $this->verificationUrl));
        session(['sent_email' => true]);
    }

    public function resendVerificationEmail()
    {
        $this->validate();
        $this->verificationUrl =  URL::temporarySignedRoute('register.verify', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $this->verificationUrl));
    }
}

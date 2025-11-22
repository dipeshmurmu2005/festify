<?php

namespace App\Livewire;

use App\Mail\EmailVerify;
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

    private $onboardUrl;

    public function mount()
    {
        session()->forget(['sent_email', 'email']);
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
        $this->sendVerification();
    }


    public function sendVerification()
    {
        $this->validate();
        $this->onboardUrl =  URL::temporarySignedRoute('onboard', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $this->onboardUrl));
        session(['sent_email' => true, 'email' => $this->email]);
    }

    public function resendVerificationEmail()
    {
        $this->validate();
        $this->onboardUrl =  URL::temporarySignedRoute('onboard', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $this->onboardUrl));
    }

    public function useDifferentEmail()
    {
        session()->forget(['sent_email', 'email']);
    }
}

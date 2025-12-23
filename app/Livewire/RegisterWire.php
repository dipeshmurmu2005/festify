<?php

namespace App\Livewire;

use App\Mail\EmailVerify;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class RegisterWire extends Component
{
    public $email;

    protected $mail_sent;

    public $fullname;

    private $onboardUrl;

    public function mount()
    {
        $this->mail_sent = (bool) Cookie::get('sent_email');
        $this->email = Cookie::get('email');
        $this->fullname = Cookie::get('fullname');
        if (auth()->user()) {
            return redirect()->route('home');
        }
    }
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email address is already registered.',

            'fullname.required' => 'Full name is required.',
            'fullname.string'   => 'Full name must be a valid text value.',
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

        // setting cookies
        Cookie::queue('sent_email', true, 5);
        Cookie::queue('email', $this->email, 5);
        Cookie::queue('fullname', $this->fullname, 5);
        $this->mail_sent = true;
    }

    public function clearCookies()
    {
        Cookie::queue(Cookie::forget('sent_email'));
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('fullname'));
        $this->mail_sent = false;
    }

    public function resendVerificationEmail()
    {
        $this->validate();
        $this->onboardUrl =  URL::temporarySignedRoute('onboard', now()->addMinutes(60), ['name' => $this->fullname, 'email' => $this->email]);
        Mail::to($this->email)->send(new EmailVerify($this->fullname, $this->onboardUrl));
    }

    public function useDifferentEmail()
    {
        $this->clearCookies();
    }
}

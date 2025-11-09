<?php

namespace App\Livewire;

use App\Mail\UpdateEmailVerify;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.settings')]
class UserProfileSetting extends Component
{
    public $name;

    public $userprofile = false;

    public $change_email = false;

    public $email;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
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

    public function updateEmail()
    {
        $this->validate(['email' => 'required|email']);
        if ($this->email != auth()->user()->email) {
            $verificationUrl = URL::temporarySignedRoute('user.update.email', now()->addMinutes(60), ['name' => auth()->user()->name, 'email' => $this->email]);
            Link::create([
                'link' => $verificationUrl,
            ]);
            Mail::to($this->email)->send(new UpdateEmailVerify($this->email, auth()->user()->name, $verificationUrl));
            $this->change_email = false;
            session()->flash('update_email', 'We’ve sent a confirmation link to your new email. Please check your inbox to complete the change');
        } else {
            return $this->addError('email', 'Please add different email.');
        }
    }
}

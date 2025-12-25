<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Locked;
use Livewire\Component;

class OnboardWire extends Component
{
    #[Locked]
    public $password_setup = false;

    #[Locked]
    public $email;

    #[Locked]
    public $name;

    public $password;

    public $password_confirmation;

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ];
    }


    public function mount(Request $request)
    {
        $this->email = $request->email;
        $this->name = $request->name;
        $user = $this->checkIfUserExist($this->email);
        if ($user) {
            if (auth()->user() && $user->id == auth()->user()->id) {
                return redirect()->route('home');
            }
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.onboard-wire');
    }

    public function completeSetup()
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'email_verified_at' => now(),
        ]);

        session()->flush();

        Auth::login($user);

        $this->clearCookies();

        return redirect()->route('home');
    }

    private function checkIfUserExist($email)
    {
        $user = User::where('email', $email)->first();
        if ($user)
            return $user;
        return false;
    }

    public function goBack()
    {
        $this->password_setup = false;
    }

    public function clearCookies()
    {
        Cookie::queue(Cookie::forget('sent_email'));
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('fullname'));
    }
}

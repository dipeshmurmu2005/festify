<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class PasswordSetupWire extends Component
{
    protected $email;

    protected $name;

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
        if (!$user) {
            session(['setup_email' => $this->email, 'setup_name' => $this->name]);
        } else {
            if ($user->id == auth()->user()->id) {
                return redirect()->route('home');
            }
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.password-setup-wire');
    }

    public function completeSetup()
    {
        $this->validate();
        $email = session('setup_email');
        $name = session('setup_name');
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $this->password,
            'email_verified_at' => now(),
        ]);

        $user->roles()->create([
            'role_id' => Role::where('name', 'user')->first()->id
        ]);
        session()->forget(['setup_email', 'setup_name']);
        return redirect()->route('home');
    }

    private function checkIfUserExist($email)
    {
        $user = User::where('email', $email)->first();
        if ($user)
            return $user;
        return false;
    }
}

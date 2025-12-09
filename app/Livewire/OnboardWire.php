<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Enums\UserTypeEnum;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.clean')]
class OnboardWire extends Component
{
    #[Locked]
    public $password_setup = false;

    #[Locked]
    public $is_organizer  = false;

    #[Locked]
    public $organizer_information = false;

    public $individual;

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

    public function messages()
    {
        return [
            'individual.required' => 'Please provide are you an individual or a company ?'
        ];
    }

    public function organizerRules()
    {
        return [
            'individual' => 'required|in:true,false'
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
        return view('livewire.onboard-wire');
    }

    public function getStartedAsOrganizer()
    {
        $this->is_organizer = true;
        $this->organizer_information = true;
    }

    public function getStartedAsUser()
    {
        $this->is_organizer = false;
        $this->password_setup = true;
    }

    public function continueAsOrganizer()
    {
        $this->validate($this->organizerRules());
        $this->password_setup = true;
    }

    public function completeSetup()
    {
        $this->validate();
        if ($this->is_organizer) {
            $this->validate($this->organizerRules());
        }
        $email = session('setup_email');
        $name = session('setup_name');

        if ($this->is_organizer) {
            $organizer =   Organizer::create([
                'name' => $name,
                'email' => $email,
                'password' => $this->password,
                'email_verified_at' => now(),
            ]);
            Auth::guard('organizer')->login($organizer);
            return redirect()->route('filament.organizer.pages.dashboard');
        }
        // $user = User::create([
        //     'name' => $name,
        //     'email' => $email,
        //     'password' => $this->password,
        //     'email_verified_at' => now(),
        //     'type' => $this->individual == 'true' ? UserTypeEnum::Individual : UserTypeEnum::Company,
        // ]);

        // $user->roles()->create([
        //     'role' => $this->is_organizer ? UserRole::EventManager : UserRole::User
        // ]);
        session()->forget(['setup_email', 'setup_name']);
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
}

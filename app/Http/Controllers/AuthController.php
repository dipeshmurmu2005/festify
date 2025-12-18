<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }
    public function googleCallback()
    {
        $driver = Socialite::driver('google');
        if (app()->environment('local')) {
            $driver->stateless();
        }
        $googleUser = $driver->user();
        if ($googleUser) {
            $user = User::where('email', $googleUser->getEmail())->first();
            $organizer = Organizer::where('email', $googleUser->getEmail())->first();
            if ($organizer) {
                Auth::guard('organizer')->login($organizer);
                return redirect()->route('filament.organizer.pages.dashboard');
            } else {
                if (!$user) {
                    $onboardUrl =  URL::temporarySignedRoute('onboard', now()->addMinutes(60), ['name' => $googleUser->getName(), 'email' => $googleUser->getEmail()]);
                    return redirect()->to($onboardUrl);
                } else {
                    Auth::login($user);
                }
            }

            session()->regenerate();
            return redirect()->route('home');
        }
        abort(403);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->back();
    }

    public function updateEmail() {}
}

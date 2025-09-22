<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $googleUser = Socialite::driver('google')->user();
        if ($googleUser) {
            $user = User::where('email', $googleUser->getEmail())->first();
            if (!$user) {
                $verificationUrl =  URL::temporarySignedRoute('register.verify', now()->addMinutes(60), ['name' => $googleUser->getName(), 'email' => $googleUser->getEmail()]);
                return redirect($verificationUrl);
            }
            Auth::login($user);
            return redirect()->route('home');
        }
        abort(403);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}

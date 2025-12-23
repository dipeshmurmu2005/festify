<?php

use App\Http\Controllers\AuthController;
use App\Livewire\ComingSoon;
use App\Livewire\EventViewWire;
use App\Livewire\ExploreWire;
use App\Livewire\HomeWire;
use App\Livewire\LoginWire;
use App\Livewire\OnboardWire;
use App\Livewire\OrganizerWire;
use App\Livewire\PasswordSetupWire;
use App\Livewire\PaymentSuccessWire;
use App\Livewire\RegisterWire;
use App\Livewire\Reservation;
use App\Livewire\SecuritySettingWire;
use App\Livewire\SetupOrganizer;
use App\Livewire\UpdateEmail;
use App\Livewire\UserProfileSetting;
use App\Livewire\UserProfileWire;
use App\Livewire\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', ComingSoon::class)->name('home');
Route::get('/', HomeWire::class)->name('home');
Route::get('/login', LoginWire::class)->name('login');
Route::get('/register', RegisterWire::class)->name('register');
Route::get('/register/verify', PasswordSetupWire::class)->name('register.verify')->middleware('signed');
Route::get('onboard', OnboardWire::class)->name('onboard')->middleware('signed');
Route::get('/auth/{platform}/redirect', [AuthController::class, 'redirect'])->name('auth.platform.redirect');
Route::get('api/auth/google/callback', [AuthController::class, 'googleCallback']);
Route::get('/update/email/verify', UpdateEmail::class)->name('user.update.email')->middleware('signed', 'validatelink');
Route::get('organizers/overview', OrganizerWire::class)->name('organizer.overview');
Route::get('event/view/{event}', EventViewWire::class)->name('event.view');
Route::get('explore', ExploreWire::class)->name('explore');
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', UserProfileWire::class)->name('user.profile');
    Route::get('/user/profile/settings', UserProfileSetting::class)->name('user.profile.setting');
    Route::post('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/user/security/settings', SecuritySettingWire::class)->name('user.security.setting');
    Route::get('/user/tickets', UserTicket::class)->name('user.tickets');
    Route::get('/setup/organizer', SetupOrganizer::class)->name('setup.organizer');
    Route::get('/reservation/view/{reservation_id}', Reservation::class)->name('view.reservation');
});

Route::get('payment/success', PaymentSuccessWire::class)->name('payment.success');

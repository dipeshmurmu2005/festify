<?php

use App\Livewire\HomeWire;
use App\Livewire\LoginWire;
use App\Livewire\PasswordSetupWire;
use App\Livewire\RegisterWire;
use App\Livewire\UserProfileSetting;
use App\Livewire\UserProfileWire;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeWire::class)->name('home');
Route::get('/login', LoginWire::class)->name('login');
Route::get('/register', RegisterWire::class)->name('register');
Route::get('/register/verify', PasswordSetupWire::class)->name('register.verify')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', UserProfileWire::class)->name('user.profile');
    Route::get('/user/profile/settings', UserProfileSetting::class)->name('user.profile.setting');
});

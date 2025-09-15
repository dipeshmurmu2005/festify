<?php

use App\Livewire\HomeWire;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeWire::class)->name('home');

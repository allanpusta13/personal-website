<?php

// use App\Http\Controllers\HomeController;

use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::profile')->name('home');

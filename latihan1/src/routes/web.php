<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowHomePage;

Route::get('/', ShowHomePage::class)->name('home');

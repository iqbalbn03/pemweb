<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\ShowHomePage;
use App\Livewire\ShowAbout;
use App\Livewire\ShowServices;
use App\Livewire\ShowPortfolio;
use App\Livewire\ShowContact;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/',ShowHomePage::class)->name('home');
Route::get('/about',ShowAbout::class)->name('about');
Route::get('/services',ShowServices::class)->name('services');
Route::get('/portfolio',ShowPortfolio::class)->name('portfolio');
Route::get('/contact',ShowContact::class)->name('contact');


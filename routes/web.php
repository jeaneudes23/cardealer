<?php

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Feature;
use App\Models\Make;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function(){
  $makes = Make::take(5)->get();
  $features = Feature::get();
  $cars = new Collection();
  foreach ($makes as $key => $make) {
    $makeTopCar = $make->cars()->with(['make','model','categories'])->first();
    $cars->push($makeTopCar);
  }
  return view('welcome', compact('makes','cars','features'));
})->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Volt::route('search', 'pages.search')->name('search');
Volt::route('compare', 'pages.compare')->name('compare');

require __DIR__.'/auth.php';

<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function(){
  $features = Feature::get();
  $listings = Listing::take(8)->get();
  $cars = Car::with(['brand:id,name,slug','types:id,name'])->take(4)->get();
  // return response()->json(['cars' => $cars]);
  return view('welcome', compact('cars','features','listings'));
})->name('home');

// Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');


Volt::route('cars', 'pages.cars.index')->name('cars.index');
Volt::route('cars/{slug}', 'pages.cars.show')->name('cars.show');
Volt::route('sales', 'pages.sales.index')->name('sales.index');
Volt::route('sales/{id}', 'pages.sales.show')->name('sales.show');
Volt::route('compare', 'pages.compare')->name('compare');
Volt::route('appointments', 'pages.appointments.index')->middleware('auth')->name('appointments.index');

require __DIR__.'/auth.php';

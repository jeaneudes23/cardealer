<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function(){
  $brands = Brand::take(5)->get();
  $features = Feature::get();
  $cars = Car::with(['brand:id,name,slug'])->withCount(['listings'])->take(8)->get();
  // return response()->json(['cars' => $cars]);
  return view('welcome', compact('brands','cars','features'));
})->name('welcome');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');


Volt::route('cars/{slug}', 'pages.cars.show')->name('cars.show');
Volt::route('search', 'pages.search')->name('search');
Volt::route('compare', 'pages.compare')->name('compare');

require __DIR__.'/auth.php';

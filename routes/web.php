<?php

use App\Http\Controllers\ReportController;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Content;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function(){
  $features = Feature::get();
  $content = Content::first();
  $listings = Listing::take(8)->get();
  $cars = Car::with(['brand:id,name,slug','types:id,name'])->take(4)->get();
  // return response()->json(['cars' => $cars]);
  return view('welcome', compact('cars','features','listings','content'));
})->name('home');

// Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');
Route::get('report', [ReportController::class, 'index'])->name('report.index');



Volt::route('cars', 'pages.cars.index')->name('cars.index');
Volt::route('cars/{slug}', 'pages.cars.show')->name('cars.show');
Volt::route('cars-for-sale', 'pages.sales.index')->name('sales.index');
Volt::route('cars-for-sale/{id}', 'pages.sales.show')->name('sales.show');
Volt::route('compare', 'pages.compare')->name('compare');
Volt::route('appointments', 'pages.appointments.index')->middleware('auth')->name('appointments.index');

require __DIR__.'/auth.php';

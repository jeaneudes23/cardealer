<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;

use function Livewire\Volt\{computed, state, layout, with};

//
layout('layouts.app');

state(['brandA' => null]);
state(['modelA' => null]);
state(['carA' => null])->url();
state(['brandB' => null]);
state(['modelB' => null]);
state(['carB' => null])->url();

$brands = computed(fn() => Brand::get(['id', 'name', 'slug']))->persist();
$modelsA = computed(fn() => CarModel::whereHas('brand', function ($query) {
  $query->where('slug', $this->brandA);
})->get(['id', 'name', 'slug']));
$modelsB = computed(fn() => CarModel::whereHas('brand', function ($query) {
  $query->where('slug', $this->brandB);
})->get(['id', 'name', 'slug']));
$carsA = computed(fn() => Car::whereHas('model', function ($query) {
  $query->where('slug', $this->modelA);
})->get());
$carsB = computed(fn() => Car::whereHas('model', function ($query) {
  $query->where('slug', $this->modelB);
})->get());

with(fn() => [
  'car_left' => Car::where('slug', $this->carA)->first(),
  'car_right' => Car::where('slug', $this->carB)->first(),
]);

$resetCars = function ($car) {
  $car == 'A' ? $this->carA = null : $this->carB = null;
}

?>

<div class="container">
  <div class="grid grid-cols-[1fr,2rem,1fr] mt-8 relative">
    <div class=" bg-gray-100 rounded-lg p-6">
      @if ($car_left)
      <div class="grid gap-4 max-w-sm mx-auto">
        <x-car-card :car="$car_left" />
        <div>
          <button wire:click="resetCars('A')" class="px-4 py-2 rounded-md bg-secondary text-secondary-foreground">Remove</button>
        </div>
      </div>
      @else
      <div class="max-w-80 mx-auto">
        <div class="grid gap-1">
          <label for="brandA">Brand</label>
          <select name="brandA" id="brandA" wire:model.live="brandA">
            <option value="">Select Brand</option>
            @foreach ($this->brands as $brand)
            <option value="{{$brand->slug}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="modelA">Model</label>
          <select name="modelA" id="modelA" wire:model.live="modelA">
            <option value="">Select Model</option>
            @foreach ($this->modelsA as $model)
            <option value="{{$model->slug}}">{{$model->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="carA">Car</label>
          <select name="carA" id="carA" wire:model.live="carA">
            <option value="">Select Car</option>
            @foreach ($this->carsA as $car)
            <option value="{{$car->slug}}">{{$car->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @endif
    </div>
    <div></div>
    <div class=" bg-gray-100 rounded-lg p-6">
      @if ($car_right)
      <div class="grid gap-4 max-w-sm mx-auto">
        <x-car-card :car="$car_right" />
        <div>
          <button wire:click="resetCars('B')" class="px-4 py-2 rounded-md bg-secondary text-secondary-foreground">Remove</button>
        </div>
      </div>
      @else
      <div class="max-w-80 mx-auto">
        <div class="grid gap-1">
          <label for="brandB">Brand</label>
          <select name="brandB" id="brandB" wire:model.live="brandB">
            <option value="">Select Brand</option>
            @foreach ($this->brands as $brand)
            <option value="{{$brand->slug}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="modelB">Model</label>
          <select name="modelB" id="modelB" wire:model.live="modelB">
            <option value="">Select Model</option>
            @foreach ($this->modelsB as $model)
            <option value="{{$model->slug}}">{{$model->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="carB">Car</label>
          <select name="carB" id="carB" wire:model.live="carB">
            <option value="">Select Car</option>
            @foreach ($this->carsB as $car)
            <option value="{{$car->slug}}">{{$car->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @endif
    </div>
    <div wire:loading class="absolute inset-0 bg-white/50 grid animate-pulse place-content-center text-secondary">
      <x-lucide-loader-circle class="size-10 animate-spin mx-auto" />
    </div>
  </div>
</div>
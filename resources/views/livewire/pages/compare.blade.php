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

<div class="container mt-12">
  <div class="grid md:grid-cols-3 mb-12">
    <div class="content-center">
      <h2 class="text-3xl font-bold capitalize text-center">Compare Cars</h2>
    </div>
    <div class="p-8 bg-gray-100 rounded-l-lg border border-r-0">
      @if ($car_left)
      <div class="grid gap-4 max-w-sm mx-auto">
        <x-car-card :car="$car_left" />
        <div>
          <button wire:click="resetCars('A')" class="px-4 py-2 rounded-md bg-secondary text-secondary-foreground">Remove</button>
        </div>
      </div>
      @else
      <div class="max-w-80 mx-auto grid gap-4">
        <h3 class="text-xl font-bold">Car 1</h3>
        <div class="grid gap-1">
          <label for="brandA" hidden>Brand</label>
          <select class="rounded-lg" name="brandA" id="brandA" wire:model.live="brandA">
            <option value="" hidden>Select Brand</option>
            @foreach ($this->brands as $brand)
            <option value="{{$brand->slug}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="modelA" hidden>Model</label>
          <select class="rounded-lg" name="modelA" id="modelA" wire:model.live="modelA">
            <option value="" hidden>Select Model</option>
            @foreach ($this->modelsA as $model)
            <option value="{{$model->slug}}">{{$model->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="carA" hidden>Car</label>
          <select class="rounded-lg" name="carA" id="carA" wire:model.live="carA">
            <option value="" hidden>Select Car</option>
            @foreach ($this->carsA as $car)
            <option value="{{$car->slug}}">{{$car->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @endif
    </div>
    <div class="p-8 bg-gray-100 rounded-r-lg border border-l-0">
      @if ($car_right)
      <div class="grid gap-4 max-w-sm mx-auto">
        <x-car-card :car="$car_right" />
        <div>
          <button wire:click="resetCars('B')" class="px-4 py-2 rounded-md bg-secondary text-secondary-foreground">Remove</button>
        </div>
      </div>
      @else
      <div class="max-w-80 mx-auto grid gap-4">
        <h3 class="text-xl font-bold">Car 2</h3>
        <div class="grid gap-1">
          <label hidden for="brandB">Brand</label>
          <select class="rounded-lg" name="brandB" id="brandB" wire:model.live="brandB">
            <option value="" hidden>Select Brand</option>
            @foreach ($this->brands as $brand)
            <option value="{{$brand->slug}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label hidden for="modelB">Model</label>
          <select class="rounded-lg" name="modelB" id="modelB" wire:model.live="modelB">
            <option value="" hidden>Select Model</option>
            @foreach ($this->modelsB as $model)
            <option value="{{$model->slug}}">{{$model->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label hidden for="carB">Car</label>
          <select class="rounded-lg" name="carB" id="carB" wire:model.live="carB">
            <option value="" hidden>Select Car</option>
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

  @if ($car_left && $car_right)
    
  {{-- Basic Info --}}
  <div x-data="{open: true}">
    <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
      <h3 class="text-xl font-semibold ">Basic Information</h3>
      <x-lucide-chevron-down class="size-6"/>
    </button>
    <div x-show="open">
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Brand</div>
        <div class="p-4 border-x">{{$car_left->brand->name}}</div>
        <div class="p-4">{{$car_right->brand->name}}</div>
      </div>
      <div class="grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Model</div>
        <div class="p-4 border-x">{{$car_left->model->name}}</div>
        <div class="p-4">{{$car_right->model->name}}</div>
      </div>
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Year</div>
        <div class="p-4 border-x">{{$car_left->year}}</div>
        <div class="p-4">{{$car_right->year}}</div>
      </div>
      <div class="grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">On Sale</div>
        <div class="p-4 border-x">{{$car_left->model->name}}</div>
        <div class="p-4">{{$car_right->model->name}}</div>
      </div>
    </div>
  </div>

  {{-- Rating Info --}}
  <div x-data="{open: true}">
    <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
      <h3 class="text-xl font-semibold ">Reviews</h3>
      <x-lucide-chevron-down class="size-6"/>
    </button>
    <div x-show="open">
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Reviews & Rating</div>
          <div class="p-4 border-x">
            <div class="flex items-center gap-1">
              @for ($i = 0; $i < 5; $i++)
                <x-lucide-star class="size-6 {{ $i + 1 <= $car_left->average_rating ? 'fill-yellow-500 ' : '' }} stroke-yellow-500 stroke-1" />
              @endfor
              ({{$car_left->reviews_count}})
            </div>
          </div>
          <div class="p-4">
            <div class="flex items-center gap-1">
              @for ($i = 0; $i < 5; $i++)
                <x-lucide-star class="size-6 {{ $i + 1 <= $car_right->average_rating ? 'fill-yellow-500 ' : '' }} stroke-yellow-500 stroke-1" />
              @endfor
              ({{$car_right->reviews_count}})
            </div>
          </div>
      </div>
    </div>
  </div>

  {{-- Engine --}}
  <div x-data="{open: true}">
    <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
      <h3 class="text-xl font-semibold ">Engine Details</h3>
      <x-lucide-chevron-down class="size-6"/>
    </button>
    <div x-show="open">
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Engine Type</div>
        <div class="p-4 border-x">{{$car_left->engine_type}}</div>
        <div class="p-4">{{$car_right->engine_type}}</div>
      </div>
      <div class="grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Fuel Type</div>
        <div class="p-4 border-x">{{$car_left->engine_type}}</div>
        <div class="p-4">{{$car_right->engine_type}}</div>
      </div>
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Horse Power</div>
        <div class="p-4 border-x">{{$car_left->horse_power}}</div>
        <div class="p-4">{{$car_right->horse_power}}</div>
      </div>
    </div>
  </div>

  {{-- Transmission --}}
  <div x-data="{open: true}">
    <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
      <h3 class="text-xl font-semibold ">Transmission</h3>
      <x-lucide-chevron-down class="size-6"/>
    </button>
    <div x-show="open">
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Transmission Type</div>
        <div class="p-4 border-x">{{$car_left->engine_type}}</div>
        <div class="p-4">{{$car_right->engine_type}}</div>
      </div>
      <div class="grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Gear Number</div>
        <div class="p-4 border-x">{{$car_left->horse_power}}</div>
        <div class="p-4">{{$car_right->horse_power}}</div>
      </div>
    </div>
  </div>

  {{-- Capacity --}}
  <div x-data="{open: true}">
    <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
      <h3 class="text-xl font-semibold ">Capacity</h3>
      <x-lucide-chevron-down class="size-6"/>
    </button>
    <div x-show="open">
      <div class="bg-gray-100 grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Fuel Tank Capacity</div>
        <div class="p-4 border-x">{{$car_left->engine_type}}</div>
        <div class="p-4">{{$car_right->engine_type}}</div>
      </div>
      <div class="grid grid-cols-3 items-start">
        <div class="p-4 font-semibold">Seating Capacity</div>
        <div class="p-4 border-x">{{$car_left->horse_power}}</div>
        <div class="p-4">{{$car_right->horse_power}}</div>
      </div>
    </div>
  </div>

    {{-- Capacity --}}
    <div x-data="{open: true}">
      <button @click="open = !open" class="w-full flex justify-between items-center py-4 border-t">
        <h3 class="text-xl font-semibold ">Measurements</h3>
        <x-lucide-chevron-down class="size-6"/>
      </button>
      <div x-show="open">
        <div class="bg-gray-100 grid grid-cols-3 items-start">
          <div class="p-4 font-semibold">Width</div>
          <div class="p-4 border-x">{{$car_left->engine_type}}</div>
          <div class="p-4">{{$car_right->engine_type}}</div>
        </div>
        <div class="grid grid-cols-3 items-start">
          <div class="p-4 font-semibold">Height</div>
          <div class="p-4 border-x">{{$car_left->horse_power}}</div>
          <div class="p-4">{{$car_right->horse_power}}</div>
        </div>
        <div class="bg-gray-100 grid grid-cols-3 items-start">
          <div class="p-4 font-semibold">Curb Weight</div>
          <div class="p-4 border-x">{{$car_left->horse_power}}</div>
          <div class="p-4">{{$car_right->horse_power}}</div>
        </div>
        <div class="grid grid-cols-3 items-start">
          <div class="p-4 font-semibold">Payload</div>
          <div class="p-4 border-x">{{$car_left->horse_power}}</div>
          <div class="p-4">{{$car_right->horse_power}}</div>
        </div>
      </div>
    </div>

  @endif

</div>
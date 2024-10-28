<?php

use App\Models\Car;

use function Livewire\Volt\{computed, state, layout, with};

//
state(['slug' => fn() => $slug]);

with(fn() => ['car' => Car::where('slug', $this->slug)->with(['brand', 'model'])->withCount(['listings', 'reviews'])->firstOrFail(),],);

layout('layouts.app');

$setTab = fn($t) => ($this->tab = $t);

?>

<div class="container my-8 space-y-16">
  <div class="grid grid-cols-2 gap-12">
    <div class="grid content-center gap-3">
      <h2 class="text-4xl font-semibold">{{ $car->name }}</h2>
      <p class="text-lg">{{ $car->summary }}</p>
      <div class="flex items-center gap-1">
        <div class="flex items-center gap-2">
          <img src="{{ asset('storage/' . $car->brand->image) }}" class="size-10" alt="">
          <a href="/" class="text-lg font-medium text-secondary">{{ $car->brand->name }}</a>
        </div>
        <span>-</span>
        <div>
          <a href="/" class="font-medium capitalize text-muted hover:underline">{{ $car->model->name }}</a>
        </div>
      </div>
    </div>
    <div>
      <img src="{{ asset('storage/' . $car->image) }}" class="rounded-lg" alt="">
    </div>
  </div>
  <div class="grid grid-cols-[3fr,1fr] items-start gap-8">
    <div class="space-y-16 pr-8 border-r ">
      <x-car-specs :car="$car"/>
      <div id="features" class="space-y-8 scroll-mt-24">
        <h3 class="text-3xl font-bold capitalize">Features</h3>
        <ul class="flex items-center gap-6 flex-wrap">
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
          <li>-Seamless Audio</li>
        </ul>
      </div>
      <div id="overview" class="max-w-screen-lg space-y-4 scroll-mt-24">
        <h2 class="text-3xl font-bold capitalize">overview</h2>
        <div class="prose max-w-none">
          {!! $car->overview !!}
        </div>
      </div>
      <livewire:pages.cars.reviews-tab :car="$car" />
      <div id="rec" class="space-y-8 scroll-mt-24">
      <h2 class="text-3xl font-bold capitalize">Recommended for you</h2>
      <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
        @foreach ($car->related() as $relatedCar)
          <x-car-card :car="$relatedCar" />
        @endforeach
      </div>
    </div>
    </div>
    <div class="sticky top-24 grid gap-2">
      <p class="text-lg font-semibold capitalize">{{$car->name}}</p>
      <div class="grid gap-1">
        <a class="text-gray-500 font-medium capitalize hover:text-secondary transition-colors inline-flex items-center gap-1" href="#specs"><x-lucide-chevron-right class="size-5"/>Specifications</a>
        <a class="text-gray-500 font-medium capitalize hover:text-secondary transition-colors inline-flex items-center gap-1" href="#features"><x-lucide-chevron-right class="size-5"/>Features</a>
        <a class="text-gray-500 font-medium capitalize hover:text-secondary transition-colors inline-flex items-center gap-1" href="#overview"><x-lucide-chevron-right class="size-5"/>Overview</a>
        <a class="text-gray-500 font-medium capitalize hover:text-secondary transition-colors inline-flex items-center gap-1" href="#reviews"><x-lucide-chevron-right class="size-5"/>Reviews</a>
        <a class="text-gray-500 font-medium capitalize hover:text-secondary transition-colors inline-flex items-center gap-1" href="#rec"><x-lucide-chevron-right class="size-5"/>Recommended</a>
      </div>
    </div>
  </div>
</div>

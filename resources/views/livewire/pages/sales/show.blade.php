<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, with};

layout('layouts.app');
state(['tabs' => ['overview']]);
state(['id' => fn() => $id]);

with(fn() => ['listing' => Listing::with(['car.model:id,name,slug', 'car.brand:id,name,slug', 'car.types:id,name,slug'])->findOrFail($this->id)]);

?>

<div class="container">

  {{-- Header --}}
  <div>
    <div class="my-6 flex items-center gap-2 font-medium">
      <a wire:navigate href="{{ route('cars.index') }}" class="text-secondary hover:underline">Cars</a>
      <span><x-heroicon-o-chevron-right class="size-5" /></span>
      <a wire:navigate href="{{ route('cars.show', $listing->car->slug) }}"
         class="text-muted hover:underline">{{ $listing->car->name }}</a>
    </div>
    <div class="mb-6 grid grid-cols-2 gap-2">
      <div class="aspect-video rounded-lg border">
        <img src="{{ asset('storage/' . $listing->images[0]) }}"
             alt="image"class="h-full w-full rounded-[inherit] object-cover">
      </div>
      <div class="grid grid-cols-2 gap-2">
        @foreach ($listing->images as $key => $image)
          <div class="relative rounded-lg border">
            <img src="{{ asset('storage/' . $image) }}" alt="image"
                 class="absolute h-full w-full rounded-[inherit] object-cover">
          </div>
        @endforeach
      </div>
    </div>
    <div>
      <h2 class="text-2xl font-bold">{{ $listing->title }}</h2>
    </div>
  </div>

  {{-- Tabs --}}
  <div>

  </div>


  {{-- content --}}
  <div class="my-section items-start grid grid-cols-[1fr,300px]">
    <div></div>
    <a wire:navigate href="{{route('cars.show' , $listing->car->slug)}}" class="p-4 border space-y-4 hover:bg-muted/20 transition-colors">
      <div>
        <img src="{{asset('storage/'.$listing->car->image)}}" alt="">
      </div>
      <p class="text-center font-semibold">{{$listing->car->name}}</p>
    </a>
  </div>
</div>

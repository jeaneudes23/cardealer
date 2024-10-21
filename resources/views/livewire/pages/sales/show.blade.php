<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, with};

layout('layouts.app');
//
state(['id' => fn() => $id]);

with(fn() => ['listing' => Listing::with(['car.model:id,name,slug', 'car.brand:id,name,slug', 'car.types:id,name,slug'])->findOrFail($this->id)]);
?>

<div class="container">
    <div class="grid grid-cols-2 gap-2 my-section">
      <div class="aspect-video border">
        <img src="{{ asset('storage/' . $listing->images[0]) }}" alt="image" class="h-full w-full rounded-lg object-cover">
      </div>
      <div class="grid grid-cols-2 gap-2">
        @foreach ($listing->images as $key => $image)
          <div class="border relative">
            <img src="{{asset('storage/'.$image)}}" alt="image" class="absolute w-full h-full object-cover rounded-lg">
          </div>
        @endforeach
      </div>
    </div>
</div>

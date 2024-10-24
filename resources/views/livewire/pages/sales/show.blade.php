<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, with};

layout('layouts.app');
state(['tab' => 'overview'])->url();
state(['tabs' => ['overview','car']]);
state(['id' => fn() => $id]);

with(fn() => ['listing' => Listing::with(['car.model:id,name,slug', 'car.brand:id,name,slug', 'car.types:id,name,slug'])->findOrFail($this->id)]);


$setTab = function($t) {
  $this->tab = $t;
};

?>

<div class="container my-8">
  {{-- Header --}}
  <div class="space-y-6">
    <div class="flex items-center gap-2 font-medium">
      <a wire:navigate href="{{ route('cars.index') }}" class="text-secondary hover:underline">Cars</a>
      <span><x-heroicon-o-chevron-right class="size-5" /></span>
      <a wire:navigate href="{{ route('cars.show', $listing->car->slug) }}"
         class="text-muted hover:underline">{{ $listing->car->name }}</a>
    </div>
    <div class="grid grid-cols-2 gap-2">
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
  {{-- content --}}
  <div class="items-start gap-12 grid grid-cols-[2fr,1fr]">
    <div>
      <div>
        @foreach ($tabs as $t)
          <x-tab-button :tab="$t" :active="$t == $tab" wire:click="setTab('{{$t}}')" wire:key="{{$t}}"/>
        @endforeach
      </div>
      <div>
        @if ($tab == 'overview')
          <x-sales.overview-tab />
        @endif
      </div>
      
    </div>
    <livewire:create-appointment :car="$listing->car"/>
  </div>
</div>

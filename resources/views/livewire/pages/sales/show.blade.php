<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, with};

layout('layouts.app');
state(['tab' => 'overview'])->url();
state(['tabs' => ['overview', 'car']]);
state(['id' => fn() => $id]);

with(fn() => ['listing' => Listing::with(['car.model:id,name,slug', 'car.brand:id,name,slug', 'car.types:id,name,slug'])->findOrFail($this->id)]);

$setTab = function ($t) {
    $this->tab = $t;
};

?>

<div class="container my-8 space-y-16">
  {{-- Header --}}
  <div class="space-y-6">
    <div class="flex items-center gap-2 text-lg font-medium">
      <a wire:navigate href="{{ route('cars.index') }}" class="text-secondary hover:underline">Cars</a>
      <span><x-heroicon-o-chevron-right class="size-5" /></span>
      <a wire:navigate href="{{ route('cars.show', $listing->car->slug) }}"
         class="hover:underline">{{ $listing->car->name }}</a>
    </div>
    <div id="gallery" class="grid grid-cols-2 gap-2">
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
      <h2 class="text-2xl font-bold max-w-screen-lg">{{ $listing->title }}</h2>
    </div>
  </div>
  {{-- content --}}
  <div class="grid grid-cols-[3fr,1fr] items-start gap-8">
    <div class="space-y-16">
      <div id="car-details" class="space-y-8 scroll-mt-20">
        <h2 class="text-3xl font-bold capitalize">Car Details</h2>
        <div class="space-y-8">
          <div class="grid grid-cols-[300px,1fr] items-center">
            <x-car-card :car="$listing->car"/>
            <div class="grid gap-6 rounded-lg bg-gray-100 p-6">
              <div class="grid gap-2 border-b">
                <h3 class="text-2xl font-semibold">Total Reviews</h3>
                <p class="text-xl font-semibold text-muted">{{ $listing->car->reviews_count }} Reviews</p>
              </div>
              <div class="grid gap-2">
                <h3 class="text-2xl font-semibold">Average rating</h3>
                <div class="flex items-center gap-4">
                  <span class="text-xl font-semibold text-muted">{{ $listing->car->average_rating }}</span>
                  <div class="flex items-center gap-1">
                    @for ($i = 0; $i < 5; $i++)
                      <x-lucide-star
                                    class="size-6 {{ $i + 1 <= $listing->car->average_rating ? 'fill-yellow-500 ' : '' }} stroke-yellow-500 stroke-1" />
                    @endfor
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-[repeat(auto-fill,minmax(200px,1fr))] gap-6">
            <div class="grid gap-1 items-start p-4 bg-secondary-50 rounded-lg text-xl">
              <div class="font-semibold flex justify-between gap-2"><span>Price</span> <span class="text-red-600 text-sm font-medium">Negotiable</span></div>
              <p class="text-gray-500">{{$listing->price}} <span class="uppercase">{{$listing->currency}}</span></p>  
            </div>
            <div class="grid gap-1 content-start p-4 bg-secondary-50 rounded-lg text-xl">
              <div class="font-semibold">Condition</div>
              <p class="text-gray-500">{{$listing->condition}}</p>
            </div>
            <div class="grid gap-1 content-start p-4 bg-secondary-50 rounded-lg text-xl">
              <div class="font-semibold">Vehicle Id</div>
              <p class="text-gray-500">{{$listing->vin}}</p>
            </div>
            <div class="grid gap-1 content-start p-4 bg-secondary-50 rounded-lg text-xl">
              <div class="font-semibold">Mileage</div>
              <p class="text-gray-500">{{$listing->mileage}}</p>
            </div>
          </div>
          <div>
            <a wire:navigate href="{{route('cars.show', $listing->car->slug)}}" class="p-2 text-gray-500 font-semibold capitalize underline hover:text-secondary inline-flex items-center gap-2">
              More Details
              <x-lucide-external-link class="size-5"/>
            </a>
          </div>
        </div>
      </div>
      <div id="overview" class="scroll-mt-24 space-y-4">
        <h2 class="text-3xl font-bold capitalize">overview</h2>
        <div class="prose max-w-none">
          {!! $listing->overview !!}
        </div>
      </div>
      <div id="appointment" class="scroll-mt-20">
        <livewire:create-appointment :car="$listing->car" />
      </div>
      <div id="recommendations" class="scroll-mt-20 space-y-8">
        <h2 class="text-3xl font-bold capitalize">Recommended for you</h2>
        <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
          @foreach ($listing->related() as $relatedListing)
            <x-listing-card :listing="$relatedListing" />
          @endforeach
        </div>
      </div>
    </div>
    <div class="sticky top-24 grid gap-2">
      <div class="grid gap-1">
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-secondary" href="#car-details"><x-lucide-chevron-right class="size-5" />Car Details</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-secondary" href="#gallery"><x-lucide-chevron-right class="size-5" />Gallery</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-secondary" href="#overview"><x-lucide-chevron-right class="size-5" />Overview</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-secondary" href="#appointment"><x-lucide-chevron-right class="size-5" />Request Appointment ?</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-secondary" href="#recommendations"><x-lucide-chevron-right class="size-5" />Recommended</a>
      </div>
    </div>
  </div>
</div>

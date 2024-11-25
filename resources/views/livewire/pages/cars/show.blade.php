<?php

use App\Models\Car;

use function Livewire\Volt\{computed, state, layout, with};

//
state(['slug' => fn() => $slug]);

with(fn() => ['car' => Car::where('slug', $this->slug)->with(['brand', 'model', 'listings', 'types']) ->withCount(['listings', 'reviews'])->firstOrFail(),],);

layout('layouts.app');

$setTab = fn($t) => ($this->tab = $t);

?>

<div class="container my-8 space-y-16">
  <div class="grid lg:grid-cols-2 gap-12">
    <div class="grid content-center gap-4">
      <h2 class="text-4xl font-semibold">{{ $car->name }}</h2>
      <p class="text-lg">{{ $car->summary }}</p>
      <div class="flex gap-4">
        <a href="#listed" class="justify-self-start bg-primary px-6 py-2 font-medium text-primary-foreground">On Sale</a>
        <a wire:navigate href="{{route('compare', ['carA' => $car->slug])}}" class="justify-self-start border-2 border-foreground px-6 py-2 font-medium">Compare</a>
      </div>
    </div>
    <div>
      <img src="{{ asset('storage/' . $car->image) }}" class="rounded-lg" alt="">
    </div>
  </div>
  <div class="grid lg:grid-cols-[1fr,auto] items-start gap-8">
    <div class="space-y-16">
      <x-car-specs :car="$car" />
      <div id="listed" class="scroll-mt-24 space-y-4">
        <h3 class="text-3xl font-bold capitalize">Listed For Sale</h3>
        <div>
          @if ($car->listing_count === 0)
            Not Listed For Sale
          @else
            <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
              @foreach ($car->listings as $listing)
                <x-listing-card :listing="$listing" />
              @endforeach
            </div>
          @endif
        </div>
      </div>
      <div id="overview" class="scroll-mt-24 space-y-4">
        <h2 class="text-3xl font-bold capitalize">overview</h2>
        <div class="prose max-w-none">
          {!! $car->overview !!}
        </div>
      </div>
      <livewire:pages.cars.reviews-tab :car="$car" />
      <div id="rec" class="scroll-mt-24 space-y-8">
        <h2 class="text-3xl font-bold capitalize">Recommended for you</h2>
        <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
          @foreach ($car->related() as $relatedCar)
            <x-car-card :car="$relatedCar" />
          @endforeach
        </div>
      </div>
    </div>
    <div class="border-l pl-8 sticky top-24 gap-2 hidden lg:grid w-[310px]">
      <p class="text-lg font-semibold capitalize">{{ $car->name }}</p>
      <div class="grid gap-1">
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-primary"
           href="#specs"><x-lucide-chevron-right class="size-5" />Specifications</a>
           <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-primary"
           href="#listed"><x-lucide-chevron-right class="size-5" />For Sale</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-primary"
           href="#overview"><x-lucide-chevron-right class="size-5" />Overview</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-primary"
           href="#reviews"><x-lucide-chevron-right class="size-5" />Reviews</a>
        <a class="inline-flex items-center gap-1 font-medium capitalize text-gray-500 transition-colors hover:text-primary"
           href="#rec"><x-lucide-chevron-right class="size-5" />Recommended</a>
      </div>
    </div>
  </div>
</div>

<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Listing;
use App\Models\Type;

use function Livewire\Volt\{computed, layout, state, usesPagination, with};

usesPagination();
layout('layouts.app');



usesPagination();
state(['per_page' => 12]);
state(['for_sale'])->url();
state(['years' => fn() => Car::distinct()->orderBy('year', 'asc')->pluck('year')]);
state(['brand'])->url();
state(['condition'])->url();
state(['type'])->url();
state(['model'])->url();
state(['min_year'])->url();
state(['max_year'])->url();
state(['min_price'])->url();
state(['min_mileage'])->url();
state(['max_price'])->url();
state(['max_mileage'])->url();
state(['page'])->url();

$toggleForSale = fn() => ($this->for_sale = !$this->for_sale);

$brands = computed(fn() => Brand::get(['id', 'name', 'slug']))->persist();
$types = computed(fn() => Type::get(['id', 'name', 'slug']))->persist();
$models = computed(fn() => CarModel::whereHas('brand' , function($query){
  $query->where('slug',$this->brand);
})->get(['id', 'name', 'slug', 'brand_id']));

with(fn() => ['listings' => Listing::search(null,$this->brand,$this->model,$this->type,$this->condition,$this->min_year,$this->max_year,$this->min_mileage,$this->max_mileage,$this->min_price,$this->max_price)->paginate($this->per_page)]);


?>

<div class="mt-12 container">
  <div class="grid grid-cols-[300px,1fr] items-start gap-8">
    <div class="border rounded-lg">
      <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-xl font-semibold capitalize">Filters</h3>
        <a href="{{route('sales.index')}}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
          <span class="p-1 bg-red-500 rounded-full text-gray-50"><x-lucide-x class="size-4"/></span>
          <span class="text-sm font-semibold capitalize sr-only">clear</span>
        </a>
      </div>
      <div class="grid gap-2 text-sm p-4 ">
        <div class="grid gap-2">
          <label for="condition" class="font-medium tracking-wide capitalize">Condition</label>
          <select wire:model.live="condition" class="w-full rounded-md focus:border-secondary focus:ring-secondary" name="brand" id="brand">
            <option value="">All</option>
            <option value="used">Used</option>
            <option value="new">New</option>
          </select>
        </div>
        <div class="grid gap-2">
          <label for="brand" class="font-medium tracking-wide capitalize">Brand</label>
          <select wire:model.live="brand" class="w-full rounded-md focus:border-secondary focus:ring-secondary" name="brand" id="brand">
            <option value="">All Brands</option>
            @foreach ($this->brands as $key => $b)
              <option value="{{ $b->slug }}">{{ $b->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="model" class="font-medium tracking-wide capitalize">Model</label>
          <select wire:key="{{ $brand }}" wire:model.live="model" class="w-full rounded-lg" name="model"id="model" >
            <option value="">All Models</option>
            @foreach ($this->models as $key => $model)
              <option value="{{ $model->slug }}">{{ $model->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-1">
          <label for="type" class="font-medium tracking-wide capitalize">Type</label>
          <select wire:model.live="type" class="w-full rounded-lg" name="type" id="type" >
            <option value="">All Types</option>
            @foreach ($this->types as $key => $type)
              <option value="{{ $type->slug }}">{{ $type->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="grid gap-2">
          <p class="font-medium tracking-wide capitalize">Years</p>
          <div class="flex items-center gap-2">
          <select wire:model.live="min_year" name="min_year" id="min_year" class=" ring-muted rounded-lg focus-within:ring-2 focus-within:ring-secondary p-2">
            <option value="">Min</option>
            @foreach ($years as $year)
              <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
          </select>
          <select wire:model.live="max_year" name="max_year" id="max_year" class=" ring-muted rounded-lg focus-within:ring-2 focus-within:ring-secondary p-2">
            <option value="">Max</option>
            @foreach ($years as $year)
              <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
          </select>
          </div>
        </div>
        <div class="grid gap-2">
          <p class="font-medium tracking-wide capitalize">Mileage</p>
          <div class="flex items-center gap-2">
            <input type="number" wire:model="min_mileage" wire:model.blur="min_mileage" class="rounded-md" placeholder="Minimum">
            <input type="number" wire:model="max_mileage" wire:model.blur="max_mileage" class="rounded-md" placeholder="Maxium">
          </div>
        </div>
        <div class="grid gap-2">
          <p class="font-medium tracking-wide capitalize">Price</p>
          <div class="flex items-center gap-2">
            <input type="number" wire:model="min_price" class="rounded-md" wire:model.blur="min_price" placeholder="Minimum">
            <input type="number" wire:model="max_price" class="rounded-md" wire:model.blur="max_price" placeholder="Maxium">
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6 items-start">
        @for ($i = 0; $i < $per_page; $i++)
          <div wire:loading.class.remove="hidden" class="hidden aspect-square animate-pulse rounded-lg bg-gray-200"></div>
        @endfor
      </div>
      <div wire:loading.remove class="grid gap-6">
        <div class="flex justify-end">
          <div>
            <button>
              Sort
            </button>
            <div class="relative">
              <div class="absolute right-0 whitespace-pre z-10 bg-background p-4 rounded-lg shadow">
                <button>Price: Low To High</button>
                <button>Price: High To Low</button>
                <button>Mileage: Low To High</button>
                <button>Mileage: High To Low</button>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6 items-start">
          @forelse ($listings as $listing)
            <x-listing-card :listing="$listing" wire:key="{{ $listing->id }}" />
          @empty
          @endforelse
        </div>
        <div>
          {{ $listings->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

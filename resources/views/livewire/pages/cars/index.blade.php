<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Type;

use function Livewire\Volt\{computed, layout, state, usesPagination, with};

usesPagination();
state(['per_page' => 12]);
state(['years' => fn() => Car::distinct()->orderBy('year', 'asc')->pluck('year')]);
state(['brand'])->url();
state(['type'])->url();
state(['model'])->url();
state(['min_year'])->url();
state(['max_year'])->url();
state(['page'])->url();

$brands = computed(fn() => Brand::get(['id', 'name', 'slug']))->persist();
$types = computed(fn() => Type::get(['id', 'name', 'slug']))->persist();
$models = computed(fn() => CarModel::whereHas('brand' , function($query){
  $query->where('slug',$this->brand);
})->get(['id', 'name', 'slug', 'brand_id']));
with(fn() => ['cars' => Car::search(null,$this->brand,$this->model,$this->type,$this->min_year,$this->max_year)->paginate($this->per_page)]);

layout('layouts.app');

?>

<div class="my-12 container grid gap-6 lg:grid-cols-[auto,1fr] items-start">
  <div class="w-[310px] hidden lg:block border rounded-lg">
    <div class="flex justify-between items-center p-4 border-b">
      <h3 class="text-xl font-semibold capitalize">Filters</h3>
      <a href="{{route('cars.index')}}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
        <span class="p-1 bg-red-500 rounded-full text-gray-50"><x-lucide-x class="size-4"/></span>
        <span class="text-sm font-semibold capitalize sr-only">clear</span>
      </a>
    </div>
    <div class="grid gap-2 p-4">
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
    </div>
  </div>
  <div>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-6">
      @for ($i = 0; $i < $per_page; $i++)
        <div wire:loading class="aspect-square w-full animate-pulse bg-muted-background"></div>
      @endfor
    </div>
    <div wire:loading.remove class="space-y-8">
      <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
        @forelse ($cars as $car)
          <x-car-card :wire:key="$car->id" :car="$car" />
        @empty
          <div class="">
            <p>No Results Found</p>
          </div>
        @endforelse
      </div>
      <div>
        {{ $cars->links() }}
      </div>
    </div>
  </div>
</div>

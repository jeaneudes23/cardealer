<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Type;

use function Livewire\Volt\{computed, layout, state, usesPagination, with};

/**
 * @property string $brand
 * @property string $year
 * @property string $model
 * @property string $for_sale
 */
usesPagination();
state(['per_page' => 12]);
state(['for_sale'])->url();
state(['years' => fn() => Car::distinct()->orderBy('year', 'asc')->pluck('year')]);
state(['brand'])->url();
state(['type'])->url();
state(['model'])->url();
state(['from'])->url();
state(['to'])->url();
state(['page'])->url();

$toggleForSale = fn() => ($this->for_sale = !$this->for_sale);

$brands = computed(fn() => Brand::get(['id', 'name', 'slug']))->persist();
$types = computed(fn() => Type::get(['id', 'name', 'slug']))->persist();
$models = computed(fn() => CarModel::whereHas('brand' , function($query){
  $query->where('slug','like','%'.$this->brand.'%');
})->get(['id', 'name', 'slug', 'brand_id']));
with(fn() => ['cars' => Car::search($this->brand)->paginate($this->per_page)]);

layout('layouts.app');

?>

<div class="my-12 container grid gap-6 lg:grid-cols-[300px,1fr] items-start">
  <div class="sticky top-20">
    <div class="grid gap-4">
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
        <select wire:model.live="model" class="w-full rounded-lg" name="type" id="type" >
          <option value="">All Types</option>
          @foreach ($this->types as $key => $type)
            <option value="{{ $type->slug }}">{{ $type->name }} </option>
          @endforeach
        </select>
      </div>
      <div class="grid gap-2">
        <p class="font-medium tracking-wide capitalize">Years</p>
        <div class="flex items-center gap-2">
        <select wire:model.live="from" name="from" id="from" class=" ring-muted rounded-lg focus-within:ring-2 focus-within:ring-secondary p-2">
          <option value="">Min</option>
          @foreach ($years as $year)
            <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
        <select wire:model.live="to" name="to" id="to" class=" ring-muted rounded-lg focus-within:ring-2 focus-within:ring-secondary p-2">
          <option value="">Max</option>
          @foreach ($years as $year)
            <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
        </div>
      </div>
    </div>
  </div>
  <div class="pl-8 border-l">
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

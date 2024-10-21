<?php

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;

use function Livewire\Volt\{computed, layout, state, usesPagination, with};

/**
 * @property string $brand
 * @property string $year
 * @property string $model
 * @property string $for_sale
 */
usesPagination();
state(['per_page' => 8]);
state(['for_sale'])->url();
state(['years' => fn () => Car::distinct()->orderBy('year', 'asc')->pluck('year')]);
state(['brand'])->url();
state(['model'])->url();
state(['from'])->url();
state(['selectedBrand']);
state(['to'])->url();
state(['page'])->url();

$toggleForSale = fn() => ($this->for_sale = !$this->for_sale);

$brands = computed(fn() => Brand::get(['id', 'name', 'slug']));
$models = computed(fn() => CarModel::with(['brand:id,slug'])->get(['id', 'name', 'slug','brand_id']));
with(fn() => ['cars' => Car::search($this->brand)->paginate($this->per_page)]);

layout('layouts.app');

?>

<div class="my-section container grid gap-6 lg:grid-cols-[300px,1fr]">
  <div class="divide-y rounded border">
    <div class="p-6 grid gap-4">
      <div>

      </div>
      <div>
        <input type="text" placeholder="hello">
        <select wire:model.live="brand" class="w-full rounded-md text-sm focus:border-secondary focus:ring-secondary" name="brand" id="brand">
          <option value="">Select Brand</option>
          @foreach ($this->brands as $key => $b)
          <option value="{{ $b->slug }}">{{ $b->name }}</option>
          @endforeach
        </select>
        <select wire:key="{{ $brand }}" wire:model.live="model" class="w-full rounded-md" name="model" id="model">
          <option value="">Select Model</option>
          @foreach ($this->models as $key => $model)
          <option x-show="'{{ $model->brand->slug }}'.includes('{{$brand}}')" value="{{ $model->slug }}">{{ $model->name }} </option>
          @endforeach
        </select>
        <div class="grid grid-cols-2 gap-2">
          <select wire:model.live="from" name="from" id="from">
            @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
            @endforeach
          </select>
          <select wire:model.live="to" name="to" id="to">
            @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-6">
      @for ($i = 0; $i < $per_page; $i++)
        <div wire:loading class="aspect-square w-full animate-pulse bg-muted-background">
    </div>
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
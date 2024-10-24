<?php

use App\Models\Car;

use function Livewire\Volt\{computed, state, layout, with};

//
state(['slug' => fn() => $slug]);

with(fn() => ['car' => Car::where('slug', $this->slug)->with(['brand', 'model'])->firstOrFail()]);
layout('layouts.app');

?>

<div class="my-8 space-y-8 container">
  <div class="grid grid-cols-2 gap-12">
    <div class="content-center grid gap-3">
      <h2 class="text-4xl font-semibold">{{ $car->name }}</h2>
      <p class="text-lg">{{$car->summary}}</p>
      <div class="flex items-center gap-1">
        <div class="flex items-center gap-2">
          <img src="{{asset('storage/'.$car->brand->image)}}" class="size-10" alt="">
          <a href="/" class="font-medium text-secondary text-lg">{{$car->brand->name}}</a>
        </div>
        <span>-</span>
        <div>
          <a href="/" class="font-medium text-muted hover:underline capitalize">{{$car->model->name}}</a>
        </div>
      </div>
    </div>
    <div>
      <img src="{{asset('storage/'.$car->image)}}" class="rounded-lg" alt="">
    </div>
  </div>
  <div class="items-start gap-12 grid grid-cols-[2fr,1fr]">
    <div></div>
  </div>
</div>
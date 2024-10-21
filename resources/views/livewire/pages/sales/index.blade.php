<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, usesPagination, with};

usesPagination();
layout('layouts.app');
state(['per_page' => 3]);

with(fn() => ['listings' => Listing::search()->paginate($this->per_page)]);

?>

<div class="py-section container">
  <div class="grid grid-cols-[300px,1fr] gap-8">
    <div>
      Filters
    </div>
    <div >
      <div wire:loading.class.remove="hidden" class="space-y-8 hidden">
        @for ($i = 0; $i < $per_page; $i++)
          <div class="grid grid-cols-[300px,1fr] shadow-xl border">
            <div class="bg-gray-200 aspect-video"></div>
            <div class="space-y-2 gap-2 p-4">
              <div class="h-2 rounded-md bg-gray-200 animate-pulse w-20"></div>
              <div class="h-2 rounded-md bg-gray-200 animate-pulse w-3/4"></div>
              <div class="h-2 rounded-md bg-gray-200 animate-pulse w-3/4"></div>
              <div class="h-2 rounded-md bg-gray-200 animate-pulse w-20"></div>
            </div>
          </div>
        @endfor
      </div>
      <div wire:loading.remove class="grid gap-8">
        @forelse ($listings as $listing)
          <x-listing-card :listing="$listing" wire:key="{{ $listing->id }}" />
        @empty
        @endforelse
        <div>
          {{$listings->links()}}
        </div>
      </div>
    </div>
  </div>
</div>

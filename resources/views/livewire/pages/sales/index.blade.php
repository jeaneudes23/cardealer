<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, usesPagination, with};

usesPagination();
layout('layouts.app');
state(['per_page' => 10]);

with(fn() => ['listings' => Listing::search()->paginate($this->per_page)]);

?>

<div class="py-section container">
  <div class="grid grid-cols-[300px,1fr] gap-8">
    <div>
      Filters
    </div>
    <div>
      <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6 items-start">
        @for ($i = 0; $i < $per_page; $i++)
          <div wire:loading.class.remove="hidden" class="hidden aspect-square animate-pulse rounded-lg bg-gray-200"></div>
        @endfor
      </div>
      <div wire:loading.remove class="grid gap-6">
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

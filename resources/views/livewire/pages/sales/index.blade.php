<?php

use App\Models\Listing;

use function Livewire\Volt\{layout, state, usesPagination, with};

usesPagination();
layout('layouts.app');
//
state(['per_page' => 8]);

with(['listings' => Listing::search()->paginate(5)]);

?>

<div class="container">
  //

  <div class="grid grid-cols-[300px,1fr] gap-8">
    <div></div>
    <div class="grid gap-8">
      @forelse ($listings as $listing)
        <x-listing-card :listing="$listing" wire:key="{{ $listing->id }}" />
      @empty
      @endforelse
    </div>
  </div>
</div>

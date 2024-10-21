<?php

use App\Models\Car;

use function Livewire\Volt\{computed, state, layout, with};

//
state(['slug' => fn() => $slug]);

with(fn () => ['car' => $this->slug]);
layout('layouts.app');

?>

<div>
  {{ $slug }}
  {{$car}}
</div>

<?php

use function Livewire\Volt\{state};

//
$resetFilters = function(){
  $this->redirectIntended(route('sales.index'),true);
}

?>

<div>
  <button wire:click="resetFilters">Reset</button>
</div>

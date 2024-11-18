<?php

use App\Models\Customer;
use App\Models\Car;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{state, with};

state(['count' => 5]);
state(['rating' => 1]);
state(['comment']);
state(['car' => fn() => $car]);

with(fn() => ['reviews' => Review::where('car_id', $this->car->id)->orderBy('created_at','desc')->take($this->count)->get(),],);

$createReview = function () {
    Review::create([
        'customer_id' => Auth::user()->id,
        'rating' => $this->rating,
        'comment' => $this->comment,
        'car_id' => $this->car->id,
    ]);

    $this->rating = 1;
    $this->comment = '';

    Notification::make()
    ->title('Review Added')
    ->success()
    ->send();
};

$setRating = function ($i) {
    $this->rating = $i;
};

$loadMore = function () {
  $this->count = $this->count+10;
}

?>

<div id="reviews" class="grid gap-16 scroll-mt-24">
  <div class="space-y-8 ">
    <h2 class="text-3xl font-bold capitalize">Customer Feedback</h2>
    <div class="p-6 rounded-lg bg-gray-100 grid grid-cols-2 gap-6">
      <div class="grid gap-2 border-r">
        <h3 class="text-2xl font-semibold">Total Reviews</h3>
        <p class="text-xl font-semibold text-muted">{{ $car->reviews_count }} Reviews</p>
      </div>
      <div class="grid gap-2">
        <h3 class="text-2xl font-semibold">Average rating</h3>
        <div class="flex items-center gap-4">
          <span class="text-xl font-semibold text-muted">{{ $car->average_rating }}</span>
          <div class="flex items-center gap-1">
            @for ($i = 0; $i < 5; $i++)
              <x-lucide-star class="size-6 {{ $i + 1 <= $car->average_rating ? 'fill-yellow-500 ' : '' }} stroke-yellow-500 stroke-1" />
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="grid gap-8">
    <div class="divide-y">
    @forelse ($reviews as $review)
      <div class="grid gap-2 py-4">
        <div class="grid gap-1">
          <div class="flex items-center gap-1">
            @for ($i = 0; $i < 5; $i++)
              <x-lucide-star class="size-4 {{ $i + 1 <= $review->rating ? 'fill-yellow-500 ' : '' }} stroke-yellow-500 stroke-1" />
            @endfor
          </div>
          <h3 class="text-lg font-semibold capitalize">{{ $review->customer->name }}</h3>
        </div>
        <p>{{ $review->comment }}</p>
      </div>
    @empty
      <div class="grid place-content-center border p-6 rounded-lg">
        <p class="text-lg font-medium capitalize">No reviews</p>
      </div>
    @endforelse
    </div>
    @if ($reviews->count() < $car->reviews_count && $reviews->count() > 0)
    <button wire:click="loadMore" class="justify-self-center rounded-md bg-foreground px-6 py-2 font-medium tracking-wide text-secondary-foreground inline-flex items-center gap-2">
      <span wire:loading wire:target="loadMore"><x-lucide-loader-circle class="size-5 animate-spin"/></span>
      More Reviews
    </button>
    @endif
  </div>
  @auth
    <form wire:submit="createReview" class="grid gap-8 border p-6 rounded-lg bg-gray-100 sticky top-20">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <label for="rating" class="font-medium">Add your rating <sup class="text-red-800">*</sup></label>
          <div id="rating" class="flex items-center gap-1">
            @for ($i = 0; $i < 5; $i++)
              <button wire:click.prevent="setRating({{ $i + 1 }})" type="button">
                <x-lucide-star class="size-8 stroke-yellow-500 stroke-1 {{ $rating >= $i + 1 ? 'fill-yellow-500' : '' }}" />
              </button>
            @endfor
          </div>
        </div>
        <div class="grid gap-2">
          <label for="comment" class="font-medium capitalize">Write your review <sup class="text-red-800">*</sup></label>
          <textarea placeholder="Write here" class="rounded-lg p-4" required name="comment" id="comment" wire:model="comment"></textarea>
        </div>
      </div>
      <div>
        <button class="rounded-md bg-secondary px-6 py-2 font-medium tracking-wide text-secondary-foreground inline-flex items-center gap-2">
          <span wire:loading wire:target="createReview"><x-lucide-loader-circle class="size-5 animate-spin"/></span>
          Submit
        </button>
      </div>
    </form>
  @endauth
</div>

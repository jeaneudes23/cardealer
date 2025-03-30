@props(['listing'])

<a href="{{ route('sales.show', $listing->id) }}" wire:navigate class="shadow-xl rounded-md overflow-hidden">
  <div class="relative w-full aspect-video self-start justify-start  bg-gray-100">
    <img src="{{ asset('storage/' . $listing->cover_image) }}" class="absolute w-full h-full object-cover">
    @if ($listing->is_negotiable)
      <div class="absolute left-0 top-0 bg-primary p-2 text-xs font-semibold text-primary-foreground">Negotiable
      </div>
    @endif
  </div>
  <div class="grid">
    <div class="p-2">
      <span class="text-xs font-medium capitalize text-muted">{{$listing->condition}}</span>
      <h3 class="font-medium max-w-lg line-clamp-2">{{ $listing->title }} </h3>
    </div>
    <div class="p-2 flex justify-between flex-wrap gap-2 items-center border-t">
      <p class="text-lg font-medium"><span>{{ number_format($listing->price,0,',','.') }} </span><span class="uppercase">{{ $listing->currency }} </span></p>
      <span class="text-sm font-medium capitalize text-muted">{{$listing->mileage > 0 ? $listing->mileage : ''}}</span>
    </div>
  </div>
</a>

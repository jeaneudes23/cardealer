@props(['listing'])

<a href="{{ route('sales.show', $listing->id) }}" wire:navigate class="grid grid-cols-[300px,1fr] shadow-xl border">
  <div class="relative">
    <img src="{{ asset('storage/' . $listing->cover_image) }}" class="absolute w-full h-full object-cover" alt="{{ $listing->title }}">
    @if ($listing->is_negotiable)
      <div class="absolute left-0 top-0 bg-secondary p-2 text-xs font-semibold text-secondary-foreground">Negotiable
      </div>
    @endif
  </div>
  <div class="space-y-2 bg-background p-4">
    <div class="flex items-center gap-2 text-sm">
      <p class="font-semibold text-secondary">{{ $listing->car->name }}</p>
      <span>-</span>
      <div>
        @foreach ($listing->car->types as $type)
          <span class="text-muted">{{ $type->name }},</span>
        @endforeach
      </div>
    </div>
    <h3 class="font-medium max-w-lg line-clamp-2">{{ $listing->title }} </h3>
    <div>
      <div class="flex items-center gap-6">
        <p>Year: {{ $listing->car->year }}</p>
        <p>Condition: <span>{{ $listing->condition }}</span></p>
        <p>Mileage: <span>{{ $listing->mileage }} KM</span></p>
      </div>
    </div>
    <div>
      <p class="text-lg font-medium"><span>{{ number_format($listing->price) }} </span><span class="uppercase">{{ $listing->currency }} </span></p>
    </div>
  </div>
</a>

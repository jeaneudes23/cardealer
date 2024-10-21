@props(['listing'])

<a href="{{ route('sales.show', $listing->id) }}" wire:navigate class="shadow-xl grid grid-cols-[300px,1fr]">
  <div class="relative">
    <img src="{{ asset('storage/' . $listing->cover_image) }}" class="aspect-video object-cover" alt="{{ $listing->title }}">
    @if ($listing->is_negotiable)
    <div class="absolute left-0 top-0 bg-secondary p-2 text-xs font-semibold text-secondary-foreground">Negotiable</div>
    @endif
  </div>
  <div class="bg-background p-4">
    <div>
      @foreach ($listing->car->types as $type)
        <span class="text-sm font-medium text-muted">{{ $type->name }},</span>
      @endforeach
    </div>
    <h3 class="font-semibold uppercase">{{ $listing->title }}</h3>
    <div>
      <div class="font-medium">
        <span class="uppercase">{{$listing->currency}}</span>
        <span>{{number_format($listing->price)}}</span>
      </div>
    </div>
  </div>
</a>
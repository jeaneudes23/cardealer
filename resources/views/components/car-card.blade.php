@props(['car'])

<a href="{{ route('cars.show', $car->slug) }}" wire:navigate class="shadow-xl rounded-md overflow-hidden">
  <div class="relative">
    <img src="{{ asset('storage/' . $car->image) }}" class="aspect-video object-cover" alt="{{ $car->name }}">
    <div class="absolute bottom-0 right-0 bg-secondary p-2 text-xs font-semibold text-secondary-foreground">
      {{ $car->brand->name }}</div>
  </div>
  <div class="bg-background p-4">
    <div>
      @foreach ($car->types as $type)
        <span class="text-sm font-medium text-muted">{{ $type->name }},</span>
      @endforeach
    </div>
    <h3 class="text-lg font-semibold uppercase">{{ $car->name }}</h3>
  </div>
</a>

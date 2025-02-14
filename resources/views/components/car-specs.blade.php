<div class="space-y-16">
  <div id="specs" class="scroll-mt-24 space-y-8">
    <h3 class="text-3xl font-bold capitalize">Specifications</h3>
    <div class="grid grid-cols-[repeat(auto-fill,minmax(200px,1fr))] gap-6">
      <!-- Brand -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Brand</h3>
        <p>{{ $car->brand->name }}</p>
      </div>

      <!-- Model -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Model</h3>
        <p>{{ $car->model->name }}</p>
      </div>

      <!-- Year -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Year</h3>
        <p>{{ $car->year }}</p>
      </div>

      <!-- Type -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Type</h3>
        <p>{{ $car->brand->name }}</p>
      </div>

      <!-- Engine Type -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Engine Type</h3>
        <p>{{ $car->engine_type }}</p>
      </div>

      <!-- Fuel Type -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Fuel Type</h3>
        <p>{{ $car->fuel_type }}</p>
      </div>

      <!-- Horsepower -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Horsepower</h3>
        <p>{{ $car->horse_power }}</p>
      </div>

      <!-- Top Speed -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Top Speed</h3>
        <p>{{ $car->top_speed }}</p>
      </div>

      <!-- Transmission -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Transmission Type</h3>
        <p>{{ $car->transmission_type }}</p>
      </div>

      <!-- Gears -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Number of Gears</h3>
        <p>{{ $car->number_of_gears }}</p>
      </div>


      <!-- Fuel Capacity -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Fuel Tank Capacity</h3>
        <p>{{ $car->fuel_tank_capacity }}</p>
      </div>


      <!-- Seating Capacity -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Seating Capacity</h3>
        <p>{{ $car->number_of_seats }}</p>
      </div>

      <!-- Width -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Width</h3>
        <p>{{ $car->width }}</p>
      </div>

      <!-- Height -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Height</h3>
        <p>{{ $car->height }}</p>
      </div>

      <!-- Curb Weight -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Curb Weight</h3>
        <p>{{ $car->curb_weight }}</p>
      </div>

      <!-- Payload -->
      <div class="grid gap-1 items-start p-4 bg-primary-50 rounded-lg text-lg">
        <h3 class="font-semibold capitalize">Payload</h3>
        <p>{{ $car->payload }}</p>
      </div>

    </div>
  </div>
  <div id="features" class="scroll-mt-24 space-y-8">
    <h3 class="text-3xl font-bold capitalize">Features</h3>
    <ul class="flex flex-wrap items-center gap-6">
      @foreach ($car->features as $feature)
        <li class="inline-flex items-center gap-2">
          <span class="text-primary"><x-lucide-check-circle class="size-5" /></span>
          <p class="font-medium capitalize">{{ $feature }}</p>
        </li>
      @endforeach
    </ul>
  </div>
</div>

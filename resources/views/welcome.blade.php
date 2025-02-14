<x-app-layout>
    <x-slot name="title">Welcome</x-slot>
    <div class="grid -mt-20">
        <div class="stack grid grid-cols-2">
            <div class="col-start-2 h-full relative rounded-custom overflow-hidden">
              <img class="absolute h-full w-full object-cover object-center" src="{{ asset('storage/'.$content->hero_section_image) }}"alt="">
              <div class="absolute inset-0 bg-black/20 bg-gradient-to-br from-black"></div>
            </div>
        </div>
        <div class="stack grid content-center container py-40 gap-8 z-10 bg-white lg:bg-transparent">
            <div class="grid gap-6 max-w-2xl">
                <span class="text-primary font-bold">{{ $content->hero_section_badge }}</span>
                <h1 class="text-4xl xl:text-7xl font-bold uppercase">{{ $content->hero_section_title }}</h1>
                <p class="text-lg">{{ $content->hero_section_description }}</p>
            </div>
            <form method="GET" action="sales" class="flex p-4 shadow-md border w-fit">
                <div class="">
                  <label for="condition" class="capitalize font-medium">Condition</label>
                  <select name="condition" id="condition" class="border-0 focus:border-0 focus:ring-0 px-0" >
                    <option value="">Any</option>
                    <option value="used">Used</option>
                    <option value="new">New</option>
                  </select>
                </div>
                <div class="grid border-x px-6 mx-2">
                    <lab for="max_price">Maximun Price</lab>
                    <input name="max_price" class="border-0 focus:border-0 focus:ring-0 px-0" type="text" placeholder="10000000 RWF">
                </div>
                <button class="bg-primary text-primary-foreground font-medium tracking-wide capitalize px-10 text-lg py-3 cursor-pointer">Search</button>
            </form>
        </div>
    </div>
    <div class="my-section">
        <div class="container space-y-16">
            <div class="space-y-4">
                <h2 class="text-center text-4xl font-bold uppercase">Popular Sales</h2>
                <hr class="border-primary mx-auto border-2 max-w-10">
            </div>
            <div class="grid sm:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-x-8 gap-y-12 justify-center">
                @foreach ($listings as $listing)
                  <x-listing-card :listing="$listing" wire:key="{{$listing->id}}"/>
                @endforeach
            </div>
            <div class="flex justify-center">
              <a href={{route('sales.index')}} wire:navigate class="bg-foreground text-primary-foreground font-medium tracking-wide py-3 px-6 uppercase">View More</a>
            </div>
        </div>
    </div>
    <div class="py-section bg-gray-100">
        <div class="container space-y-16">
            <div class="space-y-4">
                <h2 class="text-center text-4xl font-bold uppercase">Popular Cars</h2>
                <hr class="border-primary mx-auto border-2 max-w-10">
            </div>
            <div class="grid sm:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-x-8 gap-y-12 justify-center">
                @foreach ($cars as $car)
                  <x-car-card :car="$car" wire:key="{{$car->id}}"/>
                @endforeach
            </div>
            <div class="flex justify-center">
              <a href={{route('cars.index')}} wire:navigate class="bg-foreground text-primary-foreground font-medium tracking-wide py-3 px-6 uppercase">View More</a>
            </div>
        </div>
    </div>
    <div class="py-section bg-foreground text-background space-y-12">
        <div class="space-y-4">
            <h2 class="text-center text-4xl font-bold uppercase">Features </h2>
            <hr class="border-primary mx-auto border-2 max-w-10">
        </div>
        <div class="container grid sm:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-8">
            @foreach ($features as $key => $feature)
              <div class="grid content-start p-6 border cursor-pointer hover:bg-background/10 transition-colors">
                  <span class="justify-self-start size-10 grid place-content-center bg-primary font-bold rounded-full">{{ $key + 1 }}</span>
                  <h3 class="mt-6 mb-2 text-xl uppercase font-semibold">{{ $feature->title }}</h3>
                  <p class="text-background/80">{{ $feature->description }}</p>
              </div>
            @endforeach
        </div>
    </div>
    <div class="my-section container">
      <livewire:create-appointment />
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="title">Welcome</x-slot>
    <div class="grid -mt-20">
        <div class="stack grid grid-cols-2">
            <div class="col-start-2 h-full relative rounded-custom overflow-hidden">
                <img class="absolute h-full w-full object-cover object-right-bottom"
                    src="https://www.mbofcaldwell.com/wp-content/themes/DealerInspireDealerTheme/images/seo-bg.jpg"
                    alt="">
                <div class="absolute inset-0 bg-black/20 bg-gradient-to-br from-black"></div>
            </div>
        </div>
        <div class="stack grid content-center container py-40 gap-8 z-10 bg-white lg:bg-transparent">
            <div class="grid gap-6 max-w-2xl">
                <span class="text-secondary font-bold">Modern car design</span>
                <h1 class="text-4xl xl:text-8xl font-bold uppercase font-header">Find your modern car</h1>
                <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, accusantium? Lorem
                    ipsum, dolor sit amet consectetur adipisicing elit. Officiis veniam magni beatae animi distinctio
                    nihil.</p>
            </div>
            <form method="GET" action="search" class="flex p-4 shadow-md border max-w-3xl w-fit">
                <div class="grid">
                    <p class="capitalize font-medium">Brand or Model</p>
                    <input name="brand" class="border-0 focus:border-0 focus:ring-0 px-0 " type="text" placeholder="Find Now">
                </div>
                <div class="grid border-x px-6 mx-2">
                    <p>Maximun Price</p>
                    <input name="max_price" class="border-0 focus:border-0 focus:ring-0 px-0" type="text" placeholder="10000000 RWF">
                </div>
                <button class="bg-secondary text-secondary-foreground font-medium tracking-wide capitalize font-header px-10 text-lg py-3 cursor-pointer">Search</button>
            </form>
        </div>
    </div>
    <div class="my-section">
        <div class="container space-y-16">
            <div class="space-y-4">
                <h2 class="text-center text-4xl font-header font-bold uppercase">Popular Cars</h2>
                <hr class="border-secondary mx-auto border-2 max-w-10">
            </div>
            <div class="grid sm:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-x-8 gap-y-12 justify-center">
                @foreach ($cars as $car)
                  <x-car-card :car="$car" wire:key="{{$car->id}}"/>
                @endforeach
            </div>
            <div class="flex justify-center">
              <a href={{route('search')}} wire:navigate class="bg-foreground text-secondary-foreground font-medium tracking-wide py-3 px-6 uppercase">View More</a>
            </div>
        </div>
    </div>
    <div class="py-section bg-foreground text-background space-y-12">
        <div class="space-y-4">
            <h2 class="text-center text-4xl font-header font-bold uppercase">Features </h2>
            <hr class="border-secondary mx-auto border-2 max-w-10">
        </div>
        <div class="container grid sm:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-8">
            @foreach ($features as $key => $feature)
              <div class="grid content-start p-6 border cursor-pointer hover:bg-background/10 transition-colors">
                  <span class="justify-self-start size-10 grid place-content-center bg-secondary font-bold font-header rounded-full">{{ $key + 1 }}</span>
                  <h3 class="mt-6 mb-2 font-header text-xl uppercase font-semibold">{{ $feature->title }}</h3>
                  <p class="text-background/80">{{ $feature->description }}</p>
              </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

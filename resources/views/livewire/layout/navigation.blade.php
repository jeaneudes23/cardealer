<?php

use App\Livewire\Actions\Logout;
use App\Models\Make;
use App\Models\CarModel;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */

  
    public $makes;
    public $models;

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function mount(){
      $this->makes = Make::take(5)->get();
      $this->models = CarModel::take(5)->get();
    }
}; ?>

<nav id="navbar" x-data="{ open: false }" data-top="true" class="group/nav data-[top=false]:bg-background data-[top=false]:border-b transition-colors duration-200 z-50 sticky top-0 ">
    <!-- Primary Navigation Menu -->
    {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div> --}}
    <div class="container h-20 items-center flex gap-16">
      <a href="/" wire:navigate class="uppercase font-medium text-lg font-header">{{env('APP_NAME','APP')}}</a>
      <div class="flex items-center gap-6">
        <div class="group hidden lg:block">
          <div class="inline-flex items-center gap-4 cursor-pointer">
            <span class="font-medium tracking-wide">Brands</span>
            <x-heroicon-o-chevron-down class="size-5"/>
          </div>
          <div class="relative ">
            <div class="absolute left-0 bg-background shadow border w-40 rounded-lg p-2 pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 -translate-y-2 group-hover:translate-y-0 transition-all duration-200">
              <div class="grid gap-1">
                @foreach ($makes as $key => $make)
                  <a href="{{route('search' , ['make' => $make->slug])}}" wire:navigate class="capitalize p-2 rounded-md hover:bg-muted-background transition-colors text-sm tracking-wide">{{$make->name}}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="group hidden lg:block">
          <div class="inline-flex items-center gap-4 cursor-pointer">
            <span class="font-medium tracking-wide">Models</span>
            <x-heroicon-o-chevron-down class="size-5"/>
          </div>
          <div class="relative ">
            <div class="absolute left-0 bg-background shadow border w-40 rounded-lg p-2 pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 -translate-y-2 group-hover:translate-y-0 transition-all duration-200">
              <div class="grid gap-1">
                @foreach ($models as $key => $model)
                  <a href="{{route('search', ['model' => $model->slug])}}" wire:navigate class="capitalize p-2 rounded-md hover:bg-muted-background transition-colors text-sm tracking-wide">{{$model->name}}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex grow justify-end items-center">
        <div class="hidden lg:flex items-center gap-6 text-background group-data-[top=false]/nav:text-foreground">
          <div class="group hidden lg:block">
            <div class="inline-flex items-center gap-4 cursor-pointer">
              <a href="{{route('search')}}" wire:navigate class="font-medium px-2 uppercase">Find Cars</a>
              <x-heroicon-o-chevron-down class="size-5"/>
            </div>
            <div class="relative ">
              <div class="absolute left-0 bg-background text-foreground shadow border w-40 rounded-lg p-2 pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 -translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                <div class="grid gap-1">
                  <a href="{{route('search', ['for_sale','true'])}}" wire:navigate class="capitalize p-2 rounded-md hover:bg-muted-background transition-colors text-sm tracking-wide">For Sale</a>
                </div>
              </div>
            </div>
          </div>
          <a href="{{route('compare')}}" wire:navigate class="font-medium px-2 uppercase">Compare Cars</a>
          <a href="{{route('login')}}" wire:navigate class="font-medium px-2 uppercase">Login</a>
          <a href="{{route('register')}}" wire:navigate class="bg-secondary text-secondary-foreground font-medium tracking-wide py-3 px-6 uppercase">Register</a>  
        </div>
        <button class="lg:hidden p-2 rounded-md border">
          <x-heroicon-o-bars-3-center-left class="size-5"/>
          <span class="sr-only">toggle open menu</span>
        </button>
      </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div> --}}
</nav>
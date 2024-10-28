<?php

use App\Livewire\Actions\Logout;
use App\Models\Brand;
use App\Models\CarModel;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */

    public $brands;
    public $models;

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function mount()
    {
        $this->brands = Brand::take(5)->get();
        $this->models = CarModel::take(5)->get();
    }
}; ?>

<nav id="navbar" x-data="{ open: false }" data-top="false" class="group/nav sticky top-0 z-50 transition-colors duration-200 data-[top=false]:border-b data-[top=false]:bg-background">
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
  <div class="container flex h-16 items-center gap-16 ">
    <a href="/" wire:navigate class="text-secondary font-bold uppercase text-lg tracking-tighter">{{ env('APP_NAME', 'APP') }}</a>
    <div class="flex items-center gap-6">
      <div class="group hidden lg:block">
        <div class="inline-flex cursor-pointer items-center gap-4">
          <span class="p-2 font-medium tracking-wide">Brands</span>
          <x-heroicon-o-chevron-down class="size-5" />
        </div>
        <div class="relative">
          <div class="pointer-events-none absolute left-0 w-40 -translate-y-2 rounded-lg border bg-background p-2 opacity-0 shadow transition-all duration-200 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
            <div class="grid gap-1">
              @foreach ($brands as $key => $brand)
                <a href="{{ route('cars.index', ['brand' => $brand->slug]) }}" wire:navigate
                   class="rounded-md p-2 text-sm capitalize tracking-wide transition-colors hover:bg-muted-background">{{ $brand->name }}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="group hidden lg:block">
        <div class="inline-flex cursor-pointer items-center gap-4">
          <span class="p-2 font-medium tracking-wide">Models</span>
          <x-heroicon-o-chevron-down class="size-5" />
        </div>
        <div class="relative">
          <div class="pointer-events-none absolute left-0 w-40 -translate-y-2 rounded-lg border bg-background p-2 opacity-0 shadow transition-all duration-200 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
            <div class="grid gap-1">
              @foreach ($models as $key => $model)
                <a href="{{ route('cars.index', ['model' => $model->slug]) }}" wire:navigate class="rounded-md p-2 text-sm capitalize tracking-wide transition-colors hover:bg-muted-background">{{ $model->name }}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex grow items-center justify-end">
      <div class="hidden items-center gap-6 text-background group-data-[top=false]/nav:text-foreground lg:flex">
        <div class="group hidden lg:block">
          <div class="inline-flex cursor-pointer items-center gap-4">
            <a href="{{ route('cars.index') }}" wire:navigate class="p-2 font-medium capitalize">Find Cars</a>
            <x-heroicon-o-chevron-down class="size-5" />
          </div>
          <div class="relative">
            <div
                 class="pointer-events-none absolute left-0 w-40 -translate-y-2 rounded-lg border bg-background p-2 text-foreground opacity-0 shadow transition-all duration-200 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
              <div class="grid gap-1">
                <a href="{{ route('sales.index') }}" wire:navigate
                   class="rounded-md p-2 text-sm capitalize tracking-wide transition-colors hover:bg-muted-background">For
                  Sale</a>
              </div>
            </div>
          </div>
        </div>
        <a href="{{ route('compare') }}" wire:navigate class="px-2 font-medium capitalize">Compare Cars</a>
        @guest
        <a href="{{ route('login') }}" wire:navigate class="px-2 font-medium capitalize">Login</a>
        <a href="{{ route('register') }}" wire:navigate class="bg-secondary px-6 py-2 font-medium capitalize tracking-wide text-secondary-foreground">Register</a>
        @endguest
        @auth
        <a href="{{ route('appointments.index') }}" wire:navigate class="px-2 font-medium capitalize">Appointments</a>
        <div class="group hidden lg:block">
          <div class="inline-flex cursor-pointer items-center gap-4">
            <span class="p-2 font-medium tracking-wide">Profile</span>
            <x-heroicon-o-chevron-down class="size-5" />
          </div>
          <div class="relative">
            <div class="pointer-events-none absolute right-0 w-40 -translate-y-2 rounded-lg border bg-background p-2 opacity-0 shadow transition-all duration-200 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
              <div class="grid gap-1">
                <a href="{{ route('profile') }}" wire:navigate class="p-2 rounded-md text-sm font-medium capitalize hover:bg-muted-background transition-colors">Profile</a>
                <button wire:click="logout" class="p-2 rounded-md text-sm flex justify-start font-medium capitalize hover:bg-muted-background transition-colors">Logout</button>
              </div>
            </div>
          </div>
        </div>
        @endauth
      </div>
      <button class="rounded-md border p-2 lg:hidden">
        <x-heroicon-o-bars-3-center-left class="size-5" />
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

@script
  <script>
    const navbar = document.querySelector('[data-top]')
    const pageTop = document.querySelector('#page-top')
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        navbar.setAttribute('data-top', `${entry.isIntersecting}`)
      })
    })

    const path = window.location.pathname
    path === '/' && observer.observe(pageTop)
  </script>
@endscript

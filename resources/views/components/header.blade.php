<header {{ $attributes->class(['flex w-full max-w-[1920px] items-center pr-4 pl-9']) }}>
  <nav class="flex flex-1 items-center gap-3 pt-3 pb-2">
    <a href="/" class="flex items-center">
      <img src="{{ asset('logo.png') }}" alt="Logo" class="focus-visible:shadow-xs-selected h-5 w-5 rounded-md focus:outline-hidden" />
    </a>

    <a class="rounded-md px-2 py-1 font-medium border border-transparent hover:border-gray-200 hover:bg-gray-100" href="/">{{ __('Dashboard') }}</a>
    <div class="-ml-4 flex-1"></div>
    <div class="flex items-center gap-1">
      <a class="flex items-center gap-2 rounded-md px-2 py-1 font-medium border border-transparent hover:border-gray-200 hover:bg-gray-100" href="/">
        <x-phosphor-magnifying-glass class="size-4 text-gray-600 transition-transform duration-150" />
        {{ __('Search') }}
      </a>

      <a class="flex items-center gap-2 rounded-md px-2 py-1 font-medium border border-transparent hover:border-gray-200 hover:bg-gray-100" href="/">
        <x-phosphor-lifebuoy class="size-4 text-gray-600 transition-transform duration-150" />
        {{ __('Docs') }}
      </a>

      <div x-data="{ menuOpen: false }" @click.away="menuOpen = false" class="relative">
        <button @click="menuOpen = !menuOpen" :class="{ 'bg-gray-100' : menuOpen }" class="flex cursor-pointer items-center gap-1 rounded-md px-2 py-1 border border-transparent hover:border-gray-200 font-medium hover:bg-gray-100">
          {{ __('Menu') }}
          <x-phosphor-caret-down class="size-4 text-gray-600 transition-transform duration-150" x-bind:class="{ 'rotate-180' : menuOpen }" />
        </button>

        <div x-cloak x-show="menuOpen" x-transition:enter="transition duration-50 ease-linear" x-transition:enter-start="-translate-y-1 opacity-90" x-transition:enter-end="translate-y-0 opacity-100" class="absolute top-0 right-0 z-50 mt-10 w-48 min-w-[8rem] rounded-md border border-gray-200/70 bg-white p-1 text-sm text-gray-800 shadow-md" x-cloak>
          <a @click="menuOpen = false" href="/" class="relative flex w-full cursor-default items-center rounded px-2 py-1.5 outline-none select-none hover:bg-gray-100 hover:text-gray-900">
            <x-phosphor-user class="mr-2 size-4 text-gray-600" />
            {{ __('Profile') }}
          </a>

          <div class="-mx-1 my-1 h-px bg-gray-200"></div>

          <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button @click="menuOpen = false" type="submit" class="relative flex w-full cursor-default items-center rounded px-2 py-1.5 outline-none select-none hover:bg-gray-100 hover:text-gray-900">
              <x-phosphor-sign-out class="mr-2 size-4 text-gray-600" />
              {{ __('Logout') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </nav>
</header>

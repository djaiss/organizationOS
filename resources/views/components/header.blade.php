<header {{ $attributes->class(['mx-auto flex max-w-[1920px] items-center pr-4 pl-9']) }}>
  <nav class="flex flex-1 items-center gap-3 pt-4 pb-2">
    <a href="/" class="flex items-center">
      <img src="{{ asset('logo.png') }}" alt="Logo" class="h-5 w-5 focus-visible:shadow-xs-selected rounded-md focus:outline-hidden" />
    </a>

    <a class="hover:bg-gray-100 rounded-md px-3 py-1 font-medium" href="/">{{ __('Dashboard') }}</a>
    <div class="-ml-4 flex-1"></div>
    <div class="flex items-center gap-3">
      <a class="hover:bg-gray-100 rounded-md px-3 py-1 font-medium flex gap-1 items-center" href="/"><x-phosphor-lifebuoy class="text-gray-600 size-4 transition-transform duration-150" /> {{ __('Docs') }}</a>
      <a class="hover:bg-gray-100 rounded-md px-3 py-1 font-medium flex gap-1 items-center" href="/">{{ __('Menu') }} <x-phosphor-caret-down class="text-gray-600 size-4 transition-transform duration-150" /></a>
    </div>
  </nav>
</header>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('components.meta')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans text-sm text-gray-900 antialiased">
    <x-header />

    <main class="bg-gray-50 flex flex-1 flex-col px-2 py-px">
      <div class="mx-auto flex w-full grow flex-col items-stretch rounded-lg shadow-xs ring-1 ring-[#E6E7E9]">
        {{ $slot }}
      </div>
    </main>
  </body>
</html>

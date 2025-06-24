<footer {{ $attributes->class(['flex w-full max-w-[1920px] items-center pr-4 pl-9']) }}>
  <div class="flex py-3 text-gray-600 text-sm">
    <div class="flex">
      &copy; {{ config('app.name') }} &middot; {{ now()->format('Y') }}
    </div>
  </div>
</footer>

@props([
  'title' => null,
  'padding' => 'p-4',
])

<div class="flex flex-col gap-2">
  @if ($title)
    <h2 class="font-semi-bold mb-1 text-lg">{{ $title }}</h2>
  @endif

  <div {{ $attributes->merge(['class' => 'rounded-lg border border-gray-200 bg-white ' . $padding]) }}>
    {{ $slot }}
  </div>
</div>

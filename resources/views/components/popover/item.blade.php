@props([
  'href' => '',
  'before' => '',
  'after' => '',
])

@php
  $classes = [
    'group flex w-full items-center px-2 py-2 lg:py-1.5',
    'rounded-md',
    'text-left text-sm font-medium',
    'text-gray-800 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600',
  ];
@endphp

<?php if ($href): ?>

<a href="{{ $href }}" {{ $attributes->class($classes) }}>
  <?php if (is_string($before) && $before !== ''): ?>

  <x-dynamic-component :component="$before" aria-hidden="true" width="20" height="20" class="mr-2 shrink-0 text-gray-400 group-hover:text-current" />

  <?php else: ?>

  {{ $before }}

  <?php endif; ?>

  <?php if ($slot->isNotEmpty()): ?>

  <div class="flex-1 text-sm leading-none font-medium whitespace-nowrap">{{ $slot }}</div>

  <?php endif; ?>

  <?php if (is_string($after) && $after !== ''): ?>

  <x-dynamic-component :component="$after" aria-hidden="true" width="20" height="20" class="ml-2 shrink-0 text-gray-400 group-hover:text-current" />

  <?php else: ?>

  {{ $after }}

  <?php endif; ?>
</a>

<?php else: ?>

<button {{ $attributes->class($classes) }}>
  <?php if (is_string($before) && $before !== ''): ?>

  <x-dynamic-component :component="$before" aria-hidden="true" width="20" height="20" class="mr-2 shrink-0 text-gray-400 group-hover:text-current" />

  <?php else: ?>

  {{ $before }}

  <?php endif; ?>

  <?php if ($slot->isNotEmpty()): ?>

  <div class="flex-1 text-sm leading-none font-medium whitespace-nowrap">{{ $slot }}</div>

  <?php endif; ?>

  <?php if (is_string($after) && $after !== ''): ?>

  <x-dynamic-component :component="$after" aria-hidden="true" width="20" height="20" class="ml-2 shrink-0 text-gray-400 group-hover:text-current" />

  <?php else: ?>

  {{ $after }}

  <?php endif; ?>
</button>

<?php endif; ?>

@props([
  'href' => '',
  'variant' => 'primary',
  'size' => 'base',
  'before' => '',
  'after' => '',
])

@php
  $classes = [
    'inline-flex items-center justify-center gap-2',
    'relative aria-pressed:z-10', // Button group behavior
    'font-medium whitespace-nowrap',
    'disabled:pointer-events-none disabled:cursor-default disabled:opacity-75 dark:disabled:opacity-75',
    match (
      $size // Size...
    ) {
      'base' => 'h-8 rounded-lg text-sm [:where(&)]:px-3',
      'sm' => 'h-8 rounded-md text-sm [:where(&)]:px-3',
      'xs' => 'h-8 rounded-md text-xs [:where(&)]:px-2',
    },
    match (
      $variant // Background color...
    ) {
      'primary' => 'bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)]',
      'secondary' => 'bg-white hover:bg-gray-50 aria-pressed:bg-[var(--color-accent)] aria-pressed:hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] dark:bg-gray-700 dark:hover:bg-gray-600/75',
      'danger' => 'bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500',
      default => '',
    },
    match (
      $variant // Text color...
    ) {
      'primary' => 'text-[var(--color-accent-foreground)]',
      'secondary' => 'text-gray-800 aria-pressed:text-[var(--color-accent-foreground)] dark:text-white',
      'danger' => 'text-white',
      'link' => 'p-0 text-(--color-accent-content) underline decoration-[color-mix(in_oklab,var(--color-accent-content),transparent_30%)] hover:decoration-current',
      default => '',
    },
    match (
      $variant // Border color...
    ) {
      'primary' => 'border border-black/10 dark:border-0',
      'secondary' => 'border border-gray-300 border-b-gray-300/80 hover:border-gray-400 aria-pressed:border-black/10 dark:border-gray-600 dark:hover:border-gray-600 dark:aria-pressed:border-0',
      default => '',
    },
    match (
      $variant // Shadows...
    ) {
      'primary' => 'shadow-[inset_0px_1px_--theme(--color-white/.2)]',
      'secondary' => match ($size) {
        'base' => 'shadow-xs',
        'sm' => 'shadow-xs',
        'xs' => 'shadow-none',
      },
      'danger' => 'shadow-[inset_0px_1px_var(--color-red-500),inset_0px_2px_--theme(--color-white/.15)] dark:shadow-none',
      default => '',
    },
  ];
@endphp

{{-- It's important that this file does NOT have a newline at the end. --}}

<?php if ($href): ?>

<a href="{{ $href }}" {{ $attributes->class($classes) }}>
  <?php if (is_string($before) && $before !== ''): ?>

  <x-dynamic-component :component="$before" aria-hidden="true" width="20" height="20" class="-ml-0.5 shrink-0 opacity-80 group-hover:opacity-100" />

  <?php else: ?>

  {{ $before }}

  <?php endif; ?>

  {{ $slot }}

  <?php if (is_string($after) && $after !== ''): ?>

  <x-dynamic-component :component="$after" aria-hidden="true" width="20" height="20" class="-mr-0.5 shrink-0 opacity-80 group-hover:opacity-100" />

  <?php else: ?>

  {{ $after }}

  <?php endif; ?>
</a>

<?php else: ?>

<button {{ $attributes->class($classes) }}>
  <?php if (is_string($before) && $before !== ''): ?>

  <x-dynamic-component :component="$before" aria-hidden="true" width="20" height="20" class="-ml-0.5 shrink-0 opacity-80 group-hover:opacity-100" />

  <?php else: ?>

  {{ $before }}

  <?php endif; ?>

  {{ $slot }}

  <?php if (is_string($after) && $after !== ''): ?>

  <x-dynamic-component :component="$after" aria-hidden="true" width="20" height="20" class="-mr-0.5 shrink-0 opacity-80 group-hover:opacity-100" />

  <?php else: ?>

  {{ $after }}

  <?php endif; ?>
</button>

<?php endif; ?>

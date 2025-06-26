@props([
  'href',
])

@isset($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 relative aria-pressed:z-10 font-medium whitespace-nowrap disabled:pointer-events-none disabled:cursor-default disabled:opacity-75 dark:disabled:opacity-75 h-8 rounded-lg text-sm [:where(&)]:px-3 bg-white hover:bg-gray-50 aria-pressed:bg-[var(--color-accent)] aria-pressed:hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] dark:bg-gray-700 dark:hover:bg-gray-600/75 text-gray-800 aria-pressed:text-[var(--color-accent-foreground)] dark:text-white border border-gray-300 border-b-gray-300/80 hover:border-gray-400 aria-pressed:border-black/10 dark:border-gray-600 dark:hover:border-gray-600 dark:aria-pressed:border-0 shadow-xs']) }}>{{ $slot }}</a>
@else
  <button type="submit" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 relative aria-pressed:z-10 font-medium whitespace-nowrap disabled:pointer-events-none disabled:cursor-default disabled:opacity-75 dark:disabled:opacity-75 h-8 rounded-lg text-sm [:where(&)]:px-3 bg-white hover:bg-gray-50 aria-pressed:bg-[var(--color-accent)] aria-pressed:hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] dark:bg-gray-700 dark:hover:bg-gray-600/75 text-gray-800 aria-pressed:text-[var(--color-accent-foreground)] dark:text-white border border-gray-300 border-b-gray-300/80 hover:border-gray-400 aria-pressed:border-black/10 dark:border-gray-600 dark:hover:border-gray-600 dark:aria-pressed:border-0 shadow-xs']) }}>
    {{ $slot }}
  </button>
@endif

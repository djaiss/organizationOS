@props([
  'href',
])

@isset($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 relative aria-pressed:z-10 font-medium whitespace-nowrap disabled:pointer-events-none disabled:cursor-default disabled:opacity-75 dark:disabled:opacity-75 h-8 rounded-lg text-sm [:where(&)]:px-3 bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)] border border-black/10 dark:border-0 shadow-[inset_0px_1px_--theme(--color-white/.2)]']) }}>{{ $slot }}</a>
@else
  <button type="submit" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 relative aria-pressed:z-10 font-medium whitespace-nowrap disabled:pointer-events-none disabled:cursor-default disabled:opacity-75 dark:disabled:opacity-75 h-8 rounded-lg text-sm [:where(&)]:px-3 bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)] border border-black/10 dark:border-0 shadow-[inset_0px_1px_--theme(--color-white/.2)]']) }}>
    {{ $slot }}
  </button>
@endif

{{-- It's important that this file does NOT have a newline at the end. --}}
<a {{
  $attributes->class([
    'inline underline',
    'decoration-[1px]',
    'decoration-gray-300 underline-offset-3',
    'hover:text-blue-500 hover:decoration-blue-500',
    'transition-colors duration-200',
  ])
}}>{{ $slot }}</a>

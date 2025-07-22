<aside class="flex-col border-b border-gray-200 bg-white px-4 py-4 sm:flex sm:rounded-bl-lg sm:border-r sm:border-b-0">
  <nav class="flex flex-col gap-1">
    <p class="mb-1 text-xs font-medium text-gray-500 uppercase">{{ __('Account') }}</p>
    <a href="{{ route('settings.profile.index') }}" class="{{ request()->routeIs('settings.profile.index') ? 'bg-gray-100 font-medium text-gray-900' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 rounded-lg px-2 py-1">
      <x-phosphor-user class="h-4 w-4 {{ request()->routeIs('settings.profile.index') ? 'text-orange-400' : 'text-gray-500' }}" />
      {{ __('Profile') }}
    </a>
    <a href="{{ route('settings.security.index') }}" class="{{ request()->routeIs('settings.security.index') ? 'bg-gray-100 font-medium text-gray-900' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 rounded-lg px-2 py-1">
      <x-phosphor-key class="h-4 w-4 {{ request()->routeIs('settings.security.index') ? 'text-orange-400' : 'text-gray-500' }}" />
      {{ __('Security and access') }}
    </a>
    <a href="#" class="flex items-center gap-3 rounded-lg px-2 py-1 text-gray-700 hover:bg-gray-50">
      <x-phosphor-bell class="h-4 w-4" />
      {{ __('Notifications') }}
    </a>
    <a href="#" class="mt-4 flex items-center gap-3 rounded-lg px-2 py-1 text-red-600 hover:bg-red-50">
      <x-phosphor-trash class="h-4 w-4" />
      {{ __('Danger zone') }}
    </a>
  </nav>
</aside>

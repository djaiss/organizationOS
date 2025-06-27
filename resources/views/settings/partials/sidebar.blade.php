<aside class="border-r border-gray-200 bg-white rounded-bl-lg flex flex-col py-4 px-4">
  <nav class="flex flex-col gap-1">
    <p class="mb-1 uppercase text-xs font-medium text-gray-500">{{ __('Account') }}</p>
    <a href="#" class="flex items-center gap-3 px-2 py-1 rounded-lg text-gray-900 font-medium bg-gray-100">
      <x-phosphor-user-fill class="w-4 h-4 text-orange-400" />
      {{ __('Profile') }}
    </a>
    <a href="#" class="flex items-center gap-3 px-2 py-1 rounded-lg text-gray-700 hover:bg-gray-50">
      <x-phosphor-key class="w-4 h-4" />
      {{ __('API Keys') }}
    </a>
    <a href="#" class="flex items-center gap-3 px-2 py-1 rounded-lg text-gray-700 hover:bg-gray-50">
      <x-phosphor-bell class="w-4 h-4" />
      {{ __('Notifications') }}
    </a>
    <a href="#" class="flex items-center gap-3 px-2 py-1 rounded-lg text-red-600 hover:bg-red-50 mt-4">
      <x-phosphor-trash class="w-4 h-4" />
      {{ __('Danger zone') }}
    </a>
  </nav>
</aside>
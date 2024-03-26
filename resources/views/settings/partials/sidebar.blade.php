<div class="p-4 sm:p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
  <ul class="space-y-3">
    <li class="group">
      <a href="{{ route('profile.edit') }}" class="flex items-center">
        <span><x-heroicon-s-user class="w-4 h-4 mr-2 text-gray-500 group-hover:text-gray-800" /></span>
        <span>{{ __('Profile') }}</span>
      </a>
    </li>
    <li class="group">
      <a href="{{ route('settings.api.index') }}" class="flex items-center">
        <span><x-heroicon-s-key class="w-4 h-4 mr-2 text-gray-500 group-hover:text-gray-800" /></span>
        <span>{{ __('API access') }}</span>
      </a>
    </li>
  </ul>
</div>

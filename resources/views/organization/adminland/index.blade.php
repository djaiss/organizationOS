<x-app-layout>
  <x-slot name="organizationContext">
    <div class="max-w-7xl mx-auto px-4 sm:px-0 py-2">
      <ul class="text-sm">
        <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
          <x-link href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</x-link>
        </li>
        <li class="inline" dusk="header-organization-name">{{ $organization->name }}</li>
      </ul>
    </div>
  </x-slot>

  <x-slot name="navigation">
    @include('layouts.navigation')
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-0">
      <div class="settings-grid grid grid-cols-1 gap-6">
        <!-- left -->
        <div>
          @include('organization.adminland.partials.sidebar')
        </div>

        <!-- right -->
        <div class="p-0 sm:px-0 sm:py-0">
          <div class="max-w-7xl mx-auto sm:px-0 space-y-6">
            <div class="p-4 sm:p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
              <div class="max-w-xl">
                <section>
                  <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                      {{ __('Manage permissions in the organization') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                      {{ __("Permissions grant access for members. In addition to the available pre-defined permissions, you can create any custom permissions to fit your needs.") }}
                    </p>
                  </header>

                  <ul>
                    <li class="flex">
                      <div></div>
                    </li>
                  </ul>
                </section>

              </div>
            </div>

            <div class="p-4 sm:p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
              <div class="max-w-xl">
                sdf
              </div>
            </div>

            <div class="p-4 sm:p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
              <div class="max-w-xl">
                sdsf
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

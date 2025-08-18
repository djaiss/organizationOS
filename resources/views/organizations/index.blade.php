<?php
/*
 * @var OrganizationIndexViewModel $viewModel
 */
?>

<x-app-layout>
  <x-slot:title>
    {{ __('Dashboard') }}
  </x-slot>

  <div class="px-6 pt-6">
    <div class="mx-auto w-full max-w-4xl items-start justify-center">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-medium text-gray-900">{{ __('Your organizations') }}</h2>

        <x-button.secondary href="{{ route('organizations.new') }}">
          {{ __('New organization') }}
        </x-button.secondary>
      </div>

      <x-box>
        @forelse ($viewModel->organizations() as $organization)
          <div class="flex items-center justify-between">
            <a href="{{ route('organizations.show', $organization->slug) }}">{{ $organization->name }}</a>
          </div>
        @empty
          <div class="flex flex-col items-center gap-2 text-center text-gray-500">
            <div class="mb-1 rounded-full bg-gray-100 p-3">
              <x-phosphor-building-office class="size-6 text-gray-600" />
            </div>

            <p class="text-sm text-gray-500">
              {{ __('You are not a member of any organizations yet.') }}
            </p>
          </div>
        @endforelse
      </x-box>
    </div>
  </div>
</x-app-layout>

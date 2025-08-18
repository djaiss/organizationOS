<?php
/*
 * @var \App\Models\User $user
 * @var \App\Http\ViewModels\ProfileShowViewModel $viewModel
 */
?>

<x-app-layout>
  <x-slot:title>
    {{ __('Security and access') }}
  </x-slot>

  <x-breadcrumb :items="[
    ['label' => __('Dashboard'), 'route' => route('organizations.index')],
    ['label' => __('Security and access')]
  ]" />

  <!-- settings layout -->
  <div class="grid flex-grow sm:grid-cols-[220px_1fr]">
    <!-- Sidebar -->
    @include('settings.partials.sidebar')

    <!-- Main content -->
    <section class="p-4 sm:p-8">
      <div class="mx-auto max-w-2xl sm:px-0">
        <!-- user password -->
        @include('settings.security.partials.password', ['user' => $user])

        <!-- api keys -->
        @include('settings.security.partials.api.index', ['apiKeys' => $apiKeys])
      </div>
    </section>
  </div>
</x-app-layout>

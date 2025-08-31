<x-app-layout>
  <x-slot:title>
    {{ __('Organization') }}
  </x-slot>

  <x-breadcrumb :items="[
    ['label' => __('Dashboard'), 'route' => route('organizations.index')],
    ['label' => __('Organization')]
  ]" />

  bla
</x-app-layout>

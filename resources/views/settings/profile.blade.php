<x-app-layout>
  <x-slot:title>
    {{ __('Profile') }}
  </x-slot>

  <x-breadcrumb :items="[
    ['label' => __('Dashboard'), 'route' => route('organizations.index')],
    ['label' => __('Settings')]
  ]" />

  <!-- settings layout -->
  <div class="grid flex-grow sm:grid-cols-[220px_1fr]">
    <!-- Sidebar -->
    @include('settings.partials.sidebar')

    <!-- Main content -->
    <section class="p-4 sm:p-8">
      <div class="mx-auto max-w-4xl sm:px-0">
        <x-box :title="__('Details')" class="mb-6">
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="space-y-2">
              <p class="text-sm text-gray-500">{{ __('These are the details that will be displayed on your profile. Everyone within organizations you belong to will have the opportunity to view them.') }}</p>
              <p class="text-sm text-gray-500">{{ __('If you provide a nickname, it will be displayed to others instead of your real name.') }}</p>
              <p class="text-sm text-gray-500">{{ __('If you change your email address, you will need to verify it again. In this case, you will receive a new verification link.') }}</p>
            </div>

            <x-form method="put" :action="route('settings.profile.update')" class="space-y-4">
              <!-- First name -->
              <x-input id="first_name" value="{{ old('first_name', $user->first_name) }}" :label="__('First name')" required placeholder="John" :error="$errors->get('first_name')" autofocus />

              <!-- Last name -->
              <x-input id="last_name" value="{{ old('last_name', $user->last_name) }}" :label="__('Last name')" required placeholder="Doe" :error="$errors->get('last_name')" />

              <!-- nickname -->
              <x-input id="nickname" value="{{ old('nickname', $user?->nickname) }}" :label="__('Nickname')" :error="$errors->get('nickname')" />

              <!-- email -->
              <x-input id="email" value="{{ old('email', $user->email) }}" :label="__('Email')" required placeholder="john@doe.com" :error="$errors->get('email')" />

              <!-- locale -->
              <x-select id="locale" :label="__('Language')" :options="['en' => __('English'), 'fr' => __('French')]" selected="{{ $user->locale }}" required :error="$errors->get('locale')" />

              <div class="flex items-center justify-start">
                <x-button dusk="save-profile-button">{{ __('Save') }}</x-button>
              </div>
            </x-form>
          </div>
        </x-box>
      </div>
    </section>
  </div>
</x-app-layout>

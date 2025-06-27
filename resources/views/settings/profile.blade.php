<x-app-layout>
  <x-slot:title>
    {{ __('Profile') }}
  </x-slot>

  <x-breadcrumb :items="[
    ['label' => __('Dashboard'), 'route' => route('organizations.index')],
    ['label' => __('Settings')]
  ]" />

  <!-- settings layout -->
  <div class="grid grid-cols-[220px_1fr] flex-grow">
    <!-- Sidebar -->
    @include('settings.partials.sidebar')

    <!-- Main content -->
    <section class="p-8">
      <div class="mx-auto max-w-4xl px-2 py-2 sm:px-0">

        <x-box :title="__('Details')">
          <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
              <p class="text-sm text-gray-500">{{ __('These are the details that will be displayed on your profile. Everyone within organizations you belong to will have the opportunity to view them.') }}</p>
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


{{-- <x-layouts.app :title="__('Profile | Settings')">
  <section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
      <x-form method="put" action="{{ route('settings.profile.update') }}" class="my-6 w-full space-y-6">
        <x-input type="text" :label="__('Name')" :value="$user->name" name="name" required autofocus autocomplete="name" />

        <div>
          <x-input type="email" :label="__('Email')" :value="$user->email" name="email" required autocomplete="email" />

          @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
            <div>
              <x-text class="mt-4">
                {{ __('Your email address is unverified.') }}

                <x-button variant="link" :formaction="route('verification.store')" name="_method" value="post">
                  {{ __('Click here to re-send the verification email.') }}
                </x-button>
              </x-text>

              @if (session('status') === 'verification-link-sent')
                <x-text class="!dark:text-green-400 mt-2 font-medium !text-green-600">
                  {{ __('A new verification link has been sent to your email address.') }}
                </x-text>
              @endif
            </div>
          @endif
        </div>

        <div class="flex items-center gap-4">
          <div class="flex items-center justify-end">
            <x-button class="w-full">{{ __('Save') }}</x-button>
          </div>

          <x-action-message class="me-3" on="profile-updated">
            {{ __('Saved.') }}
          </x-action-message>
        </div>
      </x-form>

      <section class="mt-10 space-y-6">
        <div class="relative mb-5">
          <x-heading>{{ __('Delete account') }}</x-heading>
          <x-subheading>{{ __('Delete your account and all of its resources') }}</x-subheading>
        </div>

        <x-button type="button" variant="danger" x-init="" x-on:click="$dispatch('modal:open', 'confirm_user_deletion')">
          {{ __('Delete account') }}
        </x-button>

        <x-modal id="confirm_user_deletion" :open="$errors->has('password')">
          <x-form method="delete" action="{{ route('settings.profile.destroy') }}" class="space-y-6">
            <div>
              <x-heading size="lg">{{ __('Are you sure you want to delete your account?') }}</x-heading>
              <x-subheading>
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
              </x-subheading>
            </div>

            <x-input type="password" :label="__('Password')" name="password" />

            <div class="flex justify-end space-x-2">
              <x-button variant="secondary" form="confirm_user_deletion_close">{{ __('Cancel') }}</x-button>
              <x-button variant="danger">{{ __('Delete account') }}</x-button>
            </div>
          </x-form>
        </x-modal>
      </section>
    </x-settings.layout>
  </section>
</x-layouts.app> --}}

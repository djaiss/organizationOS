<x-guest-layout>
  <div class="grid min-h-screen w-screen grid-cols-1 lg:grid-cols-2">
    <!-- Left side - Confirm password form -->
    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col justify-center px-5 py-10 sm:px-30">
      <div class="w-full">
        @if (config('organizationos.show_marketing_site'))
          <p class="group mb-10 flex items-center gap-x-1 text-sm text-gray-600">
            <x-phosphor-arrow-left class="h-4 w-4 transition-transform duration-150 group-hover:-translate-x-1" />
            <x-link href="{{ route('marketing.index') }}" class="group-hover:underline">{{ __('Back to the marketing website') }}</x-link>
          </p>
        @endif

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Title -->
        <div class="mb-8 flex items-center gap-x-2">
          <a href="{{ route('marketing.index') }}" class="group flex items-center gap-x-2 transition-transform ease-in-out">
            <div class="flex h-7 w-7 items-center justify-center transition-all duration-400 group-hover:-translate-y-0.5 group-hover:-rotate-3">
              <img src="{{ asset('images/marketing/auth/logo.webp') }}" alt="{{ config('app.name') }} logo" width="25" height="25" srcset="{{ asset('images/marketing/auth/logo.webp') }} 1x, {{ asset('images/marketing/auth/logo@2x.webp') }} 2x" />
            </div>
          </a>
          <h1 class="text-2xl font-semibold text-gray-900">
            {{ __('Confirm password') }}
          </h1>
        </div>

        <!-- Confirm password form -->
        <x-box class="mb-8">
          <p class="mb-4 text-sm text-gray-600">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>

          <x-form method="post" action="{{ route('confirmation.store') }}" class="space-y-4">
            <!-- Password -->
            <x-input id="password" type="password" :label="__('Password')" required autocomplete="current-password" />

            <x-button class="w-full" dusk="confirm-password-button">{{ __('Confirm') }}</x-button>
          </x-form>
        </x-box>

        <ul class="text-xs text-gray-600">
          <li>© {{ config('app.name') }} {{ now()->format('Y') }}</li>
        </ul>
      </div>
    </div>

    <!-- Right side - Image -->
    <div class="relative hidden bg-gray-400 lg:block">
      <!-- Quote Box -->
      <div class="absolute inset-0 flex items-center justify-center">bla</div>
    </div>
  </div>
</x-guest-layout>

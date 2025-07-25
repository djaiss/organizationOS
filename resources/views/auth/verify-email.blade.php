<x-guest-layout>
  <div class="grid min-h-screen w-screen grid-cols-1 lg:grid-cols-2">
    <!-- Left side - Login form -->
    <div class="mx-auto flex w-full max-w-3xl flex-1 flex-col justify-center px-5 py-10 sm:px-30">
      <div class="w-full">
        <!-- Title -->
        <div class="mb-8">
          <div class="flex items-center gap-x-2">
            <a href="{{ route('marketing.index') }}" class="group flex items-center gap-x-2 transition-transform ease-in-out">
              <div class="flex h-7 w-7 items-center justify-center transition-all duration-400 group-hover:-translate-y-0.5 group-hover:-rotate-3">
                <img src="{{ asset('images/marketing/auth/logo.webp') }}" alt="{{ config('app.name') }} logo" width="25" height="25" srcset="{{ asset('images/marketing/auth/logo.webp') }} 1x, {{ asset('images/marketing/auth/logo@2x.webp') }} 2x" />
              </div>
            </a>
            <h1 class="mb-2 text-2xl font-semibold text-gray-900">
              {{ __('Thanks for signing up!') }}
            </h1>
          </div>
          <p class="text-sm text-gray-500">{{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
        </div>

        <x-box class="mb-12">
          <x-form method="post" :action="route('verification.store')" class="space-y-6">
            @if (session('status') == 'verification-link-sent')
              <p class="!dark:text-green-400 text-center font-medium !text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
              </p>
            @endif

            <div class="flex flex-col items-center justify-between space-y-3">
              <x-form method="post" action="{{ route('verification.store') }}">
                <x-button class="w-full">
                  {{ __('Resend verification email') }}
                </x-button>
              </x-form>
              <x-form method="post" action="{{ route('logout') }}">
                <x-button variant="link">{{ __('Log out') }}</x-button>
              </x-form>
            </div>
          </x-form>
        </x-box>

        <ul class="text-xs text-gray-600">
          <li>&copy; {{ config('app.name') }} {{ now()->format('Y') }}</li>
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

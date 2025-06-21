<x-guest-layout>
  <div class="grid min-h-screen w-screen grid-cols-1 lg:grid-cols-2">
    <!-- Left side - Login form -->
    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col justify-center px-5 py-10 sm:px-30">
      <div class="w-full">
        @if (config('organizationos.show_marketing_site'))
          <p class="group mb-10 flex items-center gap-x-1 text-sm text-gray-600">
            <x-lucide-arrow-left class="h-4 w-4 transition-transform duration-150 group-hover:-translate-x-1" />
            <a href="{{ route('marketing.index') }}" class="group-hover:underline">{{ __('Back to the marketing website') }}</a>
          </p>
        @endif

        <!-- Title -->
        <div class="mb-8 flex items-center gap-x-2">
          <a href="{{ route('marketing.index') }}" class="group flex items-center gap-x-2 transition-transform ease-in-out">
            <div class="flex h-7 w-7 items-center justify-center transition-all duration-400 group-hover:-translate-y-0.5 group-hover:-rotate-3">
              <img src="{{ asset('marketing/logo.webp') }}" alt="PeopleOS logo" width="25" height="25" srcset="{{ asset('marketing/logo.webp') }} 1x, {{ asset('marketing/logo@2x.webp') }} 2x" />
            </div>
          </a>
          <h1 class="text-2xl font-semibold text-gray-900">
            {{ __('Welcome back') }}
          </h1>
        </div>

        <!-- Login form -->
        <div class="mt-6 mb-12 w-full overflow-hidden rounded-lg bg-white p-4 shadow-md sm:max-w-md dark:bg-gray-900">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email address -->
            <div>
              <x-input-label for="email" :value="__('Email')" class="mb-2" />
              <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus :avoidAutofill="false" autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
              <x-input-label for="password" :value="__('Password')" class="mb-2" />
              <x-text-input id="password" class="block w-full" type="password" name="password" required :avoidAutofill="false" autocomplete="current-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember me -->
            <div class="mt-4 block">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:ring-indigo-500" name="remember" />
                <span class="ms-2 text-sm text-gray-600">
                  {{ __('Remember me') }}
                </span>
              </label>
            </div>

            @if (config('peopleos.enable_anti_spam'))
              <div class="mt-4 mb-0">
                <x-turnstile data-size="flexible" />

                <x-input-error :messages="$errors->get('cf-turnstile-response')" class="mt-2" />
              </div>
            @endif

            <div class="mt-6 flex items-center justify-between">
              @if (Route::has('password.request'))
                <x-link href="{{ route('password.request') }}" class="text-sm text-gray-600">
                  {{ __('Forgot your password?') }}
                </x-link>
              @endif

              <x-button.primary>
                {{ __('Log in') }}
              </x-button.primary>
            </div>
          </form>
        </div>

        <!-- send me a link -->
        <div class="mb-4 rounded-md border border-gray-200 bg-white p-4 text-center text-sm text-gray-600">
          {{ __('Wanna skip the password?') }}
          <x-link :href="route('magic.link')" class="ml-1">
            {{ __('Send me a link instead') }}
          </x-link>
        </div>

        <!-- Register link -->
        <div class="mb-8 rounded-md border border-gray-200 bg-white p-4 text-center text-sm text-gray-600">
          {{ __('New to PeopleOS?') }}
          <x-link :href="route('register')" class="ml-1">
            {{ __('Create an account') }}
          </x-link>
        </div>

        <ul class="text-xs text-gray-600">
          <li>© {{ config('app.name') }} {{ now()->format('Y') }}</li>
        </ul>
      </div>
    </div>

    <!-- Right side - Image -->
    <div class="login-image relative hidden lg:block">
      <!-- Quote Box -->
      <div class="absolute inset-0 flex items-center justify-center">bla</div>
    </div>
  </div>
</x-guest-layout>

<x-layouts.auth :title="__('Log in')">
  <div class="space-y-6">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <x-form method="post" :action="route('login')" class="space-y-6">
      <x-input type="email" :label="__('Email address')" name="email" required autofocus autocomplete="email" />

      <div class="relative">
        <x-input type="password" :label="__('Password')" name="password" required autocomplete="current-password" />

        @if (Route::has('password.request'))
          <x-link class="absolute top-0 right-0 text-sm" :href="route('password.request')">
            {{ __('Forgot your password?') }}
          </x-link>
        @endif
      </div>

      <x-checkbox name="remember" :label="__('Remember me')" />

      <x-button class="w-full">{{ __('Log in') }}</x-button>
    </x-form>

    @if (Route::has('register'))
      <p class="text-center text-sm text-gray-600 dark:text-gray-400">
        <span>{{ __('Don\'t have an account?') }}</span>
        <x-link :href="route('register')">Sign up</x-link>
      </p>
    @endif
  </div>
</x-layouts.auth>

<div>
  <div class="mb-8 border border-gray-200 bg-white sm:rounded-lg">
    <div class="grid grid-cols-3 items-center rounded-lg p-3 hover:bg-blue-50">
      <div class="col-span-2">
        <p class="col-span-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
          {{ __('Use two factor authentication') }}
        </p>
        <x-help>{{ __('Use an authentication app or browser extension to get two-factor authentication codes when prompted.') }}</x-help>
      </div>

      <div class="justify-self-end">
        <div wire:click="toggle" x-data="{
          switchOn:
            {{ $user->hasEnabledTwoFactorAuthentication() ? 'true' : 'false' }},
        }" class="flex items-center justify-center space-x-2">
          <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn" />

          <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn" :class="switchOn ? 'bg-blue-600' : 'bg-neutral-200'" class="relative ml-2 inline-flex h-4 w-8 rounded-full py-0.5 focus:outline-none" x-cloak>
            <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="h-3 w-3 rounded-full bg-white shadow-md duration-200 ease-in-out"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

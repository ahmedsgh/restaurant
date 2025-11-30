<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<form wire:submit="updatePassword" class="space-y-5">
    <div>
        <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Current Password') }}</label>
        <input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" />
        @error('current_password') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="update_password_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.New Password') }}</label>
        <input wire:model="password" id="update_password_password" name="password" type="password" autocomplete="new-password"
            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" />
        @error('password') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Confirm Password') }}</label>
        <input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" />
        @error('password_confirmation') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
            <svg wire:loading wire:target="updatePassword" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ __('all.Save') }}
        </button>

        <span x-data="{ show: false }" x-init="@this.on('password-updated', () => { show = true; setTimeout(() => show = false, 2000); })" x-show="show" x-transition class="text-sm text-green-600 dark:text-green-400 font-medium">
            {{ __('all.Saved.') }}
        </span>
    </div>
</form>

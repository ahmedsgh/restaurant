<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';
    public bool $confirmingDeletion = false;

    public function confirmDeletion(): void
    {
        $this->confirmingDeletion = true;
    }

    public function cancelDeletion(): void
    {
        $this->confirmingDeletion = false;
        $this->reset('password');
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="space-y-4">
    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('all.Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    @if(!$confirmingDeletion)
        <button wire:click="confirmDeletion" type="button" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent bg-gradient-to-r from-red-500 to-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-red-600 hover:to-rose-700 transition-all duration-200">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
            {{ __('all.Delete Account') }}
        </button>
    @else
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 space-y-4">
            <div>
                <h4 class="text-sm font-semibold text-red-800 dark:text-red-300">{{ __('all.Are you sure you want to delete your account?') }}</h4>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ __('all.Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <div>
                <label for="delete_password" class="block text-sm font-medium text-red-700 dark:text-red-300 mb-1.5">{{ __('all.Password') }}</label>
                <input wire:model="password" id="delete_password" name="password" type="password" placeholder="{{ __('all.Enter your password to confirm') }}"
                    class="w-full rounded-xl border-red-300 dark:border-red-700 dark:bg-red-900/30 dark:text-white focus:border-red-500 focus:ring-red-500" />
                @error('password') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <button wire:click="deleteUser" type="button" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent bg-gradient-to-r from-red-500 to-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-red-600 hover:to-rose-700 transition-all duration-200">
                    <svg wire:loading wire:target="deleteUser" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('all.Delete Account') }}
                </button>
                <button wire:click="cancelDeletion" type="button" class="inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    {{ __('all.Cancel') }}
                </button>
            </div>
        </div>
    @endif
</div>

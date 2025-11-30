<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<form wire:submit="updateProfileInformation" class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }}</label>
        <input wire:model="name" id="name" name="name" type="text" required autofocus autocomplete="name" 
            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" />
        @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Email') }}</label>
        <input wire:model="email" id="email" name="email" type="email" required autocomplete="username" 
            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" />
        @error('email') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror

        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div class="mt-3 p-3 rounded-xl bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800">
                <p class="text-sm text-yellow-800 dark:text-yellow-300">
                    {{ __('all.Your email address is unverified.') }}
                    <button wire:click.prevent="sendVerification" class="underline font-medium hover:text-yellow-600 dark:hover:text-yellow-200">
                        {{ __('all.Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('all.A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
            <svg wire:loading wire:target="updateProfileInformation" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ __('all.Save') }}
        </button>

        <span x-data="{ show: false }" x-init="@this.on('profile-updated', () => { show = true; setTimeout(() => show = false, 2000); })" x-show="show" x-transition class="text-sm text-green-600 dark:text-green-400 font-medium">
            {{ __('all.Saved.') }}
        </span>
    </div>
</form>

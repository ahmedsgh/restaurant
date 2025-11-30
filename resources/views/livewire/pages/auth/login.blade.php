<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Welcome back') }}</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('all.Sign in to your account to continue') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                {{ __('all.Email') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <input 
                    wire:model="form.email" 
                    id="email" 
                    type="email" 
                    name="email" 
                    required 
                    autofocus 
                    autocomplete="username"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                    placeholder="you@example.com"
                />
            </div>
            @error('form.email')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                {{ __('all.Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <input 
                    wire:model="form.password" 
                    id="password" 
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                    placeholder="••••••••"
                />
            </div>
            @error('form.password')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input 
                    wire:model="form.remember" 
                    id="remember" 
                    type="checkbox" 
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-amber-600 focus:ring-amber-500 dark:bg-gray-800 transition-colors"
                />
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('all.Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-amber-600 hover:text-amber-500 dark:text-amber-500 dark:hover:text-amber-400 transition-colors">
                    {{ __('all.Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-x-2 py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200"
        >
            <span wire:loading.remove wire:target="login">{{ __('all.Log in') }}</span>
            <svg wire:loading wire:target="login" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </form>

    <!-- Contact Admin Note -->
    <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
        {{ __('all.Need an account? Contact your administrator.') }}
    </p>
</div>

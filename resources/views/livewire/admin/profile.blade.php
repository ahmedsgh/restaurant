<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Profile') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Manage your account settings') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
        <!-- Profile Information -->
        <div class="lg:col-span-2 flex">
            <div class="w-full rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden flex flex-col">
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Profile Information') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.Update your account profile information and email address.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex-1">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>
        </div>

        <!-- Account Info Card -->
        <div class="lg:col-span-1 flex">
            <div class="w-full rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden flex flex-col">
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Account Details') }}</h3>
                </div>
                <div class="p-6 flex-1 flex items-center justify-center">
                    <div class="flex flex-col items-center text-center">
                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-2xl font-bold text-white mb-4">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        <div class="mt-4 flex items-center gap-2">
                            @if(auth()->user()->email_verified_at)
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('all.Verified') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 dark:bg-yellow-900/50 px-2.5 py-1 text-xs font-medium text-yellow-700 dark:text-yellow-400">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                    {{ __('all.Unverified') }}
                                </span>
                            @endif
                        </div>
                        <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                            {{ __('all.Member since') }} {{ auth()->user()->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Password -->
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Update Password') }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.Ensure your account is using a long, random password to stay secure.') }}</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <livewire:profile.update-password-form />
        </div>
    </div>

    <!-- Delete Account -->
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-red-200 dark:ring-red-900/50 overflow-hidden">
        <div class="border-b border-red-200 dark:border-red-900/50 px-6 py-4 bg-red-50 dark:bg-red-900/20">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 dark:text-red-400">{{ __('all.Danger Zone') }}</h3>
                    <p class="text-sm text-red-600 dark:text-red-400/80">{{ __('all.Permanently delete your account and all associated data.') }}</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <livewire:profile.delete-user-form />
        </div>
    </div>
</div>

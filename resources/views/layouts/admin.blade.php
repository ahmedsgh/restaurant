<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Restaurant') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="h-full font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div x-data="{ sidebarOpen: false }" class="min-h-full">
            <!-- Mobile sidebar overlay -->
            <div x-show="sidebarOpen" x-cloak class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900/80"></div>

                <div class="fixed inset-0 flex">
                    <div x-show="sidebarOpen"
                         x-transition:enter="transition ease-in-out duration-300 transform"
                         x-transition:enter-start="-translate-x-full"
                         x-transition:enter-end="translate-x-0"
                         x-transition:leave="transition ease-in-out duration-300 transform"
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="-translate-x-full"
                         @click.away="sidebarOpen = false"
                         class="relative mr-16 flex w-full max-w-xs flex-1">
                        <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                            <button type="button" @click="sidebarOpen = false" class="-m-2.5 p-2.5">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Mobile Sidebar component -->
                        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white dark:bg-gray-800 px-6 pb-4 ring-1 ring-gray-900/10 dark:ring-gray-700">
                            @include('components.admin.sidebar-content')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-6 pb-4">
                    @include('components.admin.sidebar-content')
                </div>
            </div>

            <div class="lg:pl-72">
                <!-- Top navbar -->
                <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                    <button type="button" @click="sidebarOpen = true" class="-m-2.5 p-2.5 text-gray-700 dark:text-gray-200 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Separator -->
                    <div class="h-6 w-px bg-gray-200 dark:bg-gray-700 lg:hidden" aria-hidden="true"></div>

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <!-- Search -->
                        <div class="relative flex flex-1 items-center">
                            @if(isset($search))
                                {{ $search }}
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <!-- Language Switcher -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" type="button" class="flex items-center gap-x-1.5 p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
                                    </svg>
                                    <span class="text-xs font-medium uppercase">{{ app()->getLocale() }}</span>
                                </button>
                                <div x-show="open" 
                                     x-cloak
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-xl bg-white dark:bg-gray-800 py-1 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 focus:outline-none">
                                    <a href="{{ route('lang.switch', 'en') }}" class="flex items-center gap-x-2 px-4 py-2 text-sm {{ app()->getLocale() == 'en' ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <span class="text-base">🇺🇸</span> English
                                    </a>
                                    <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center gap-x-2 px-4 py-2 text-sm {{ app()->getLocale() == 'fr' ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <span class="text-base">🇫🇷</span> Français
                                    </a>
                                    <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center gap-x-2 px-4 py-2 text-sm {{ app()->getLocale() == 'ar' ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <span class="text-base">🇲🇦</span> العربية
                                    </a>
                                    <a href="{{ route('lang.switch', 'es') }}" class="flex items-center gap-x-2 px-4 py-2 text-sm {{ app()->getLocale() == 'es' ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <span class="text-base">🇪🇸</span> Español
                                    </a>
                                </div>
                            </div>

                            <!-- Visit site link -->
                            <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-x-1 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                                <span>{{ __('all.Visit Site') }}</span>
                            </a>

                            <!-- Separator -->
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200 dark:lg:bg-gray-700" aria-hidden="true"></div>

                            <!-- Profile dropdown -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="hidden lg:flex lg:items-center">
                                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900 dark:text-white" aria-hidden="true">{{ auth()->user()->name }}</span>
                                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>

                                <div x-show="open" 
                                     x-cloak
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-xl bg-white dark:bg-gray-800 py-2 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 focus:outline-none">
                                    <a href="{{ route('profile') }}" class="flex items-center gap-x-3 px-4 py-2 text-sm leading-6 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        {{ __('all.Profile') }}
                                    </a>
                                    <hr class="my-1 border-gray-100 dark:border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center gap-x-3 px-4 py-2 text-sm leading-6 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                            </svg>
                                            {{ __('all.Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <main class="py-6">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <!-- Page header -->
                        @if(isset($header))
                            <div class="mb-6">
                                {{ $header }}
                            </div>
                        @endif
                        
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>

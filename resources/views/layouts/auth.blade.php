<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Authentication' }} - {{ config('app.name', 'Restaurant') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased">
        <div class="min-h-full flex">
            <!-- Left side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-amber-500 via-orange-500 to-orange-600">
                <!-- Decorative pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#grid)" />
                    </svg>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center items-center w-full px-12 text-white">
                    <!-- Logo -->
                    <div class="mb-8">
                        <div class="h-20 w-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-xl">
                            <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                            </svg>
                        </div>
                    </div>
                    
                    <h1 class="text-4xl font-bold text-center mb-4">{{ config('app.name', 'Restaurant') }}</h1>
                    <p class="text-xl text-white/80 text-center mb-8 max-w-md">{{ __('all.Welcome to the admin panel') }}</p>
                    
                    <!-- Features list -->
                    <div class="space-y-4 text-white/90">
                        <div class="flex items-center gap-x-3">
                            <div class="h-8 w-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>{{ __('all.Manage your menu and products') }}</span>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <div class="h-8 w-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>{{ __('all.Track orders in real-time') }}</span>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <div class="h-8 w-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>{{ __('all.Handle reservations efficiently') }}</span>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <div class="h-8 w-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>{{ __('all.View analytics and insights') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative circles -->
                <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-white/10"></div>
                <div class="absolute -top-10 -right-10 h-40 w-40 rounded-full bg-white/10"></div>
            </div>
            
            <!-- Right side - Form -->
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24 bg-gray-50 dark:bg-gray-900">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <!-- Mobile logo -->
                    <div class="lg:hidden mb-8 flex justify-center">
                        <div class="h-16 w-16 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg">
                            <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                            </svg>
                        </div>
                    </div>
                    
                    {{ $slot }}
                    
                    <!-- Back to site link -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-x-2 text-sm text-gray-500 hover:text-amber-600 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            {{ __('all.Back to website') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

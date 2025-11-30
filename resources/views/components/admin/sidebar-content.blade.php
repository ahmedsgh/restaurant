<!-- Logo -->
<div class="flex h-16 shrink-0 items-center">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-x-3">
        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg">
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
            </svg>
        </div>
        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Restaurant') }}</span>
    </a>
</div>

<!-- Navigation -->
<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <!-- Dashboard -->
                @can('view_dashboard')
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('dashboard') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        {{ __('all.Dashboard') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        <!-- Menu Management Section -->
        @canany(['view_categories', 'view_products'])
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">{{ __('all.Menu Management') }}</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <!-- Categories -->
                @can('view_categories')
                <li>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.categories.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        {{ __('all.Categories') }}
                        @php $categoriesCount = \App\Models\Category::count(); @endphp
                        @if($categoriesCount > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.categories.*') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }} px-2 py-0.5 text-center text-xs font-medium leading-5">
                                {{ $categoriesCount }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan

                <!-- Products -->
                @can('view_products')
                <li>
                    <a href="{{ route('admin.products.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.products.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                        </svg>
                        {{ __('all.Products') }}
                        @php $productsCount = \App\Models\Product::count(); @endphp
                        @if($productsCount > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.products.*') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }} px-2 py-0.5 text-center text-xs font-medium leading-5">
                                {{ $productsCount }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        <!-- Operations Section -->
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">{{ __('all.Operations') }}</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <!-- Orders -->
                @can('view_orders')
                <li>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.orders.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        {{ __('all.Orders') }}
                        @php $pendingOrders = \App\Models\Order::where('status', 'pending')->count(); @endphp
                        @if($pendingOrders > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.orders.*') ? 'bg-white/20 text-white' : 'bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400' }} px-2 py-0.5 text-center text-xs font-medium leading-5 ring-1 ring-inset {{ request()->routeIs('admin.orders.*') ? 'ring-white/20' : 'ring-amber-500/20' }}">
                                {{ $pendingOrders }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan

                <!-- Reservations -->
                @can('view_reservations')
                <li>
                    <a href="{{ route('admin.reservations.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.reservations.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.reservations.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                        {{ __('all.Reservations') }}
                        @php $pendingReservations = \App\Models\Reservation::where('status', 'pending')->count(); @endphp
                        @if($pendingReservations > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.reservations.*') ? 'bg-white/20 text-white' : 'bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400' }} px-2 py-0.5 text-center text-xs font-medium leading-5 ring-1 ring-inset {{ request()->routeIs('admin.reservations.*') ? 'ring-white/20' : 'ring-blue-500/20' }}">
                                {{ $pendingReservations }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        <!-- Administration Section -->
        @canany(['view_users', 'view_roles'])
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">{{ __('all.Administration') }}</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <!-- Users -->
                @can('view_users')
                <li>
                    <a href="{{ route('admin.users.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.users.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        {{ __('all.Users') }}
                        @php $usersCount = \App\Models\User::count(); @endphp
                        @if($usersCount > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.users.*') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }} px-2 py-0.5 text-center text-xs font-medium leading-5">
                                {{ $usersCount }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan

                <!-- Roles & Permissions -->
                @can('view_roles')
                <li>
                    <a href="{{ route('admin.roles.index') }}" 
                       class="group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-150
                              {{ request()->routeIs('admin.roles.*') 
                                 ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' 
                                 : 'text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-500 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.roles.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        {{ __('all.Roles & Permissions') }}
                        @php $rolesCount = \Spatie\Permission\Models\Role::count(); @endphp
                        @if($rolesCount > 0)
                            <span class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full {{ request()->routeIs('admin.roles.*') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }} px-2 py-0.5 text-center text-xs font-medium leading-5">
                                {{ $rolesCount }}
                            </span>
                        @endif
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        <!-- Quick Stats at bottom -->
        <li class="mt-auto">
            <div class="rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50 p-4 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="flex items-center gap-x-3">
                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('all.Today\'s Revenue') }}</p>
                        @php $todayRevenue = \App\Models\Order::whereDate('created_at', today())->sum('total'); @endphp
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($todayRevenue, 2) }} DH</p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

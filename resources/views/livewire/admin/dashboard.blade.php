<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Dashboard') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Overview of your restaurant performance') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <select wire:model.live="period" class="rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-sm focus:ring-amber-500 focus:border-amber-500">
                <option value="7">{{ __('all.Last 7 days') }}</option>
                <option value="14">{{ __('all.Last 14 days') }}</option>
                <option value="30">{{ __('all.Last 30 days') }}</option>
                <option value="90">{{ __('all.Last 90 days') }}</option>
            </select>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Revenue -->
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-lg shadow-green-500/30">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Total Revenue') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalRevenue, 2) }} DH</p>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                @if($revenueGrowth >= 0)
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/50 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        {{ $revenueGrowth }}%
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-red-100 dark:bg-red-900/50 px-2 py-1 text-xs font-medium text-red-700 dark:text-red-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        {{ abs($revenueGrowth) }}%
                    </span>
                @endif
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('all.vs previous period') }}</span>
            </div>
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-green-500/10"></div>
        </div>

        <!-- Total Orders -->
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Total Orders') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</p>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                @if($ordersGrowth >= 0)
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/50 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        {{ $ordersGrowth }}%
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-red-100 dark:bg-red-900/50 px-2 py-1 text-xs font-medium text-red-700 dark:text-red-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        {{ abs($ordersGrowth) }}%
                    </span>
                @endif
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('all.vs previous period') }}</span>
            </div>
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-blue-500/10"></div>
        </div>

        <!-- Pending Orders -->
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 shadow-lg shadow-amber-500/30">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Pending Orders') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingOrders }}</p>
                </div>
            </div>
            <div class="mt-4">
                @if($pendingOrders > 0)
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">
                        {{ __('all.View pending') }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @else
                    <span class="text-sm text-green-600 dark:text-green-400">{{ __('all.All caught up!') }}</span>
                @endif
            </div>
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-amber-500/10"></div>
        </div>

        <!-- Reservations -->
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 shadow-lg shadow-purple-500/30">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Reservations') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalReservations }}</p>
                </div>
            </div>
            <div class="mt-4">
                @if($pendingReservations > 0)
                    <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 dark:bg-purple-900/50 px-2 py-1 text-xs font-medium text-purple-700 dark:text-purple-400">
                        {{ $pendingReservations }} {{ __('all.pending') }}
                    </span>
                @else
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.No pending reservations') }}</span>
                @endif
            </div>
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-purple-500/10"></div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Revenue Chart -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Revenue Overview') }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.Daily revenue for selected period') }}</p>
                </div>
            </div>
            <div class="h-64" x-data="revenueChart(@js($revenueChartData))" x-init="initChart()">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>

        <!-- Orders Chart -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Orders Overview') }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.Daily orders for selected period') }}</p>
                </div>
            </div>
            <div class="h-64" x-data="ordersChart(@js($ordersChartData))" x-init="initChart()">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>
    </div>

    <!-- Orders Distribution -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Orders by Type -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('all.Orders by Type') }}</h3>
            <div class="space-y-4">
                @php
                    $typeColors = ['delivery' => 'blue', 'takeaway' => 'amber', 'inplace' => 'green'];
                    $typeIcons = [
                        'delivery' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />',
                        'takeaway' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />',
                        'inplace' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />'
                    ];
                    $total = array_sum($ordersByType) ?: 1;
                @endphp
                @foreach(['delivery', 'takeaway', 'inplace'] as $type)
                    @php $count = $ordersByType[$type] ?? 0; $percentage = round(($count / $total) * 100); @endphp
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-{{ $typeColors[$type] }}-100 dark:bg-{{ $typeColors[$type] }}-900/50">
                            <svg class="h-5 w-5 text-{{ $typeColors[$type] }}-600 dark:text-{{ $typeColors[$type] }}-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                {!! $typeIcons[$type] !!}
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ __('all.' . ucfirst($type)) }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $count }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-gray-100 dark:bg-gray-700">
                                <div class="h-2 rounded-full bg-{{ $typeColors[$type] }}-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Orders by Status -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('all.Orders by Status') }}</h3>
            <div class="space-y-4">
                @php
                    $statusColors = ['pending' => 'yellow', 'preparing' => 'blue', 'ready' => 'green', 'completed' => 'gray'];
                    $totalStatus = array_sum($ordersByStatus) ?: 1;
                @endphp
                @foreach(['pending', 'preparing', 'ready', 'completed'] as $status)
                    @php $count = $ordersByStatus[$status] ?? 0; $percentage = round(($count / $totalStatus) * 100); @endphp
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-{{ $statusColors[$status] }}-100 dark:bg-{{ $statusColors[$status] }}-900/50">
                            <div class="h-3 w-3 rounded-full bg-{{ $statusColors[$status] }}-500"></div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ __('all.' . ucfirst($status)) }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $count }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-gray-100 dark:bg-gray-700">
                                <div class="h-2 rounded-full bg-{{ $statusColors[$status] }}-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Active Products -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('all.Menu Overview') }}</h3>
            <div class="text-center py-4">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/50 dark:to-orange-900/50 mb-4">
                    <span class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $totalProducts }}</span>
                </div>
                <p class="text-gray-500 dark:text-gray-400">{{ __('all.Active Products') }}</p>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('all.Categories') }}</span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ \App\Models\Category::where('is_active', true)->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Orders -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Recent Orders') }}</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">
                        {{ __('all.View all') }}
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentOrders as $order)
                    <div class="p-4 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">#{{ substr($order->tracking_code, -4) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $order->customer_name ?? 'Guest' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($order->total, 2) }} DH</p>
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-400' : '' }}
                                {{ $order->status == 'preparing' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-400' : '' }}
                                {{ $order->status == 'ready' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400' : '' }}
                                {{ $order->status == 'completed' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('all.No orders yet') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Reservations -->
        <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Upcoming Reservations') }}</h3>
                    <a href="{{ route('admin.reservations.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">
                        {{ __('all.View all') }}
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($upcomingReservations as $reservation)
                    <div class="p-4 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/50">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $reservation->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->guests }} {{ __('all.guests') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($reservation->date)->format('M d') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reservation->time }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('all.No upcoming reservations') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function revenueChart(data) {
        return {
            chart: null,
            initChart() {
                const ctx = this.$refs.canvas.getContext('2d');
                const isDark = document.documentElement.classList.contains('dark');
                
                this.chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.map(d => d.date),
                        datasets: [{
                            label: 'Revenue',
                            data: data.map(d => d.value),
                            borderColor: '#f59e0b',
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#f59e0b',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)' },
                                ticks: { color: isDark ? '#9ca3af' : '#6b7280' }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: isDark ? '#9ca3af' : '#6b7280' }
                            }
                        }
                    }
                });
            }
        }
    }

    function ordersChart(data) {
        return {
            chart: null,
            initChart() {
                const ctx = this.$refs.canvas.getContext('2d');
                const isDark = document.documentElement.classList.contains('dark');
                
                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.date),
                        datasets: [{
                            label: 'Orders',
                            data: data.map(d => d.value),
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)' },
                                ticks: { 
                                    color: isDark ? '#9ca3af' : '#6b7280',
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: isDark ? '#9ca3af' : '#6b7280' }
                            }
                        }
                    }
                });
            }
        }
    }
</script>
@endpush

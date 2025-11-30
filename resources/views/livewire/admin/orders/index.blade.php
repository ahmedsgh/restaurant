<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Orders Management') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Track and manage customer orders') }}</p>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="rounded-xl bg-green-50 dark:bg-green-900/50 p-4 ring-1 ring-green-200 dark:ring-green-800">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <!-- Orders Table -->
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Tracking Code') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Customer') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Type') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Total') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Date') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-2 font-mono text-sm font-semibold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5z" />
                                    </svg>
                                    {{ $order->tracking_code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($order->customer_name ?? 'N', 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->customer_name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $order->customer_phone ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->type == 'delivery')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-purple-100 dark:bg-purple-900/50 px-2.5 py-1 text-xs font-medium text-purple-700 dark:text-purple-400">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-5.25M15 12H3.375" />
                                        </svg>
                                        {{ __('all.Delivery') }}
                                    </span>
                                @elseif($order->type == 'pickup')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 dark:bg-blue-900/50 px-2.5 py-1 text-xs font-medium text-blue-700 dark:text-blue-400">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                                        </svg>
                                        {{ __('all.Pickup') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 dark:bg-amber-900/50 px-2.5 py-1 text-xs font-medium text-amber-700 dark:text-amber-400">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                        {{ __('all.Dine-in') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($order->total, 2) }} DH</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusConfig = [
                                        'pending' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/50', 'text' => 'text-yellow-700 dark:text-yellow-400', 'dot' => 'bg-yellow-500'],
                                        'preparing' => ['bg' => 'bg-blue-100 dark:bg-blue-900/50', 'text' => 'text-blue-700 dark:text-blue-400', 'dot' => 'bg-blue-500'],
                                        'ready' => ['bg' => 'bg-green-100 dark:bg-green-900/50', 'text' => 'text-green-700 dark:text-green-400', 'dot' => 'bg-green-500'],
                                        'completed' => ['bg' => 'bg-gray-100 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-400', 'dot' => 'bg-gray-500'],
                                    ];
                                    $config = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full {{ $config['bg'] }} px-2.5 py-1 text-xs font-medium {{ $config['text'] }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="viewOrder({{ $order->id }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 rounded-lg hover:bg-amber-200 dark:hover:bg-amber-900/50 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ __('all.View') }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                                </svg>
                                <h3 class="mt-4 text-sm font-semibold text-gray-900 dark:text-white">{{ __('all.No orders yet') }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Orders will appear here when customers place them') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Details Modal -->
    @if($selectedOrder)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity" wire:click="closeModal"></div>
                <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
                <div class="inline-block w-full transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left align-bottom shadow-xl transition-all sm:my-8 sm:max-w-2xl sm:align-middle">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-orange-500">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('all.Order Details') }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $selectedOrder->tracking_code }}</p>
                                </div>
                            </div>
                            <button wire:click="closeModal" class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-5 space-y-6">
                        <!-- Customer Info -->
                        <div class="rounded-xl bg-gray-50 dark:bg-gray-700/50 p-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                {{ __('all.Customer Information') }}
                            </h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">{{ __('all.Name') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedOrder->customer_name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">{{ __('all.Phone') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedOrder->customer_phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">{{ __('all.Type') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($selectedOrder->type) }}</p>
                                </div>
                                @if($selectedOrder->type == 'delivery')
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">{{ __('all.Address') }}</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $selectedOrder->customer_address }}</p>
                                    </div>
                                @endif
                                @if($selectedOrder->type == 'inplace')
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">{{ __('all.Table') }}</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $selectedOrder->table_number }}</p>
                                    </div>
                                @endif
                            </div>
                            @if($selectedOrder->note)
                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('all.Note') }}</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedOrder->note }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Order Items -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                                </svg>
                                {{ __('all.Order Items') }}
                            </h4>
                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($selectedOrder->items as $item)
                                    <div class="p-3 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <span class="flex-shrink-0 h-8 w-8 rounded-lg bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center text-sm font-semibold text-amber-700 dark:text-amber-400">{{ $item->quantity }}x</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</span>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($item->price * $item->quantity, 2) }} DH</span>
                                    </div>
                                @endforeach
                                <div class="p-3 flex items-center justify-between bg-gray-50 dark:bg-gray-700/50">
                                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ __('all.Total') }}</span>
                                    <span class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ number_format($selectedOrder->total, 2) }} DH</span>
                                </div>
                            </div>
                        </div>

                        <!-- Update Status -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                {{ __('all.Update Status') }}
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'pending')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all {{ $selectedOrder->status == 'pending' ? 'bg-yellow-500 text-white shadow-lg shadow-yellow-500/30' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200 dark:bg-yellow-900/50 dark:text-yellow-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $selectedOrder->status == 'pending' ? 'bg-white' : 'bg-yellow-500' }}"></span>
                                    {{ __('all.Pending') }}
                                </button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'preparing')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all {{ $selectedOrder->status == 'preparing' ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900/50 dark:text-blue-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $selectedOrder->status == 'preparing' ? 'bg-white' : 'bg-blue-500' }}"></span>
                                    {{ __('all.Preparing') }}
                                </button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'ready')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all {{ $selectedOrder->status == 'ready' ? 'bg-green-500 text-white shadow-lg shadow-green-500/30' : 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/50 dark:text-green-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $selectedOrder->status == 'ready' ? 'bg-white' : 'bg-green-500' }}"></span>
                                    {{ __('all.Ready') }}
                                </button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'completed')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all {{ $selectedOrder->status == 'completed' ? 'bg-gray-600 text-white shadow-lg shadow-gray-500/30' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $selectedOrder->status == 'completed' ? 'bg-white' : 'bg-gray-500' }}"></span>
                                    {{ __('all.Completed') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end">
                        <button wire:click="closeModal" class="inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            {{ __('all.Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">{{ __('all.Track Your Order') }}</h2>

        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <div class="max-w-xl mx-auto">
                <form wire:submit.prevent="trackOrder" class="flex gap-4">
                    <input type="text" wire:model="trackingCode" placeholder="Enter Tracking Code (e.g. ORD-123)" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        {{ __('all.Track') }}
                    </button>
                    @if($trackingCode)
                        <button type="button" wire:click="clearFilter" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            {{ __('all.Clear') }}
                        </button>
                    @endif
                </form>
                @if(session('error'))
                    <div class="mt-4 text-center text-red-500">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            @if($filteredOrders->count() > 0)
                @foreach($filteredOrders as $order)
                    <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-10">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('all.Order Details') }} <span class="text-gray-500">#{{ $order->tracking_code }}</span></h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Items') }}</h4>
                            <ul class="mt-2 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($order->items as $item)
                                    <li class="py-3 flex justify-between">
                                        <div class="flex items-center">
                                            <span class="text-gray-900 dark:text-white">{{ $item->product->name }}</span>
                                            <span class="ml-2 text-gray-500 text-sm">x{{ $item->quantity }}</span>
                                        </div>
                                        <span class="text-gray-900 dark:text-white">{{ $item->price }} DH</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-4 flex justify-between border-t border-gray-200 dark:border-gray-700 pt-4">
                                <span class="font-bold text-gray-900 dark:text-white">{{ __('all.Total') }}</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->total }} DH</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('all.Status Timeline') }}</h4>
                            <!-- Simple Timeline -->
                            <div class="mt-4 flex items-center justify-between">
                                @foreach(['pending', 'preparing', 'ready', 'completed'] as $step)
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status == $step || in_array($order->status, array_slice(['pending', 'preparing', 'ready', 'completed'], array_search($step, ['pending', 'preparing', 'ready', 'completed']) + 1)) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                            @if($order->status == $step || in_array($order->status, array_slice(['pending', 'preparing', 'ready', 'completed'], array_search($step, ['pending', 'preparing', 'ready', 'completed']) + 1)))
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                <span class="text-xs">{{ $loop->iteration }}</span>
                                            @endif
                                        </div>
                                        <span class="mt-2 text-xs {{ $order->status == $step ? 'font-bold text-orange-600' : 'text-gray-500' }}">{{ ucfirst($step) }}</span>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="flex-1 h-1 bg-gray-200 mx-2">
                                            <div class="h-full bg-orange-600" style="width: {{ in_array($order->status, array_slice(['pending', 'preparing', 'ready', 'completed'], array_search($step, ['pending', 'preparing', 'ready', 'completed']) + 1)) ? '100%' : '0%' }}"></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($orders->count() > 0 && $trackingCode)
                <div class="mt-10 text-center text-red-500">
                    {{ __('all.Order not found.') }}
                </div>
            @elseif($orders->count() == 0)
                <div class="mt-10 text-center text-gray-500">
                    <p class="text-lg">{{ __('all.You have no orders yet.') }}</p>
                    <a href="{{ route('menu') }}" wire:navigate class="mt-4 inline-block text-orange-600 hover:text-orange-500">{{ __('all.Browse Menu') }}</a>
                </div>
            @endif
        </div>
    </div>
</div>

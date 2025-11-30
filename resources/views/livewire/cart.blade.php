<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">{{ __('all.Your Cart') }}</h2>

        @if(count($cartItems) > 0)
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($cartItems as $productId => $item)
                        <li class="p-4 sm:p-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="h-16 w-16 object-cover rounded-md"
                                    src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('images/placeholder.svg') }}" alt="{{ $item['name'] }}">
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $item['name'] }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $item['price'] }} DH</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] - 1 }})"
                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                    <span class="px-3 py-1 text-gray-900 dark:text-white">{{ $item['quantity'] }}</span>
                                    <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] + 1 }})"
                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                                </div>
                                <button wire:click="removeItem({{ $productId }})" class="text-red-600 hover:text-red-800">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="p-4 sm:p-6 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ __('all.Total') }}: {{ $total }} DH</span>
                    <a href="{{ route('checkout') }}" wire:navigate
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                        {{ __('all.Proceed to Checkout') }}
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-xl text-gray-500">{{ __('all.Your cart is empty.') }}</p>
                <a href="{{ route('menu') }}" wire:navigate
                    class="mt-4 inline-block text-orange-600 hover:text-orange-500">{{ __('all.Browse Menu') }}</a>
            </div>
        @endif
    </div>
</div>

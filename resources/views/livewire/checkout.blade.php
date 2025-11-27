<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">{{ __('all.Checkout') }}</h2>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Order Summary -->
            <div class="mt-10 lg:mt-0 order-2 lg:order-1">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('all.Order Summary') }}</h3>
                <div
                    class="mt-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($cartItems as $item)
                            <li class="flex py-6 px-4 sm:px-6">
                                <div class="flex-shrink-0">
                                    <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('images/placeholder.svg') }}"
                                        alt="{{ $item['name'] }}" class="w-20 h-20 rounded-md object-center object-cover">
                                </div>
                                <div class="ml-6 flex-1 flex flex-col">
                                    <div class="flex">
                                        <div class="min-w-0 flex-1">
                                            <h4
                                                class="text-sm font-medium text-gray-700 dark:text-white hover:text-gray-800">
                                                {{ $item['name'] }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="flex-1 pt-2 flex items-end justify-between">
                                        <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                            ${{ $item['price'] }} x {{ $item['quantity'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <dl class="border-t border-gray-200 dark:border-gray-700 py-6 px-4 sm:px-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900 dark:text-white">{{ __('all.Total') }}</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">${{ $total }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="mt-10 lg:mt-0 order-1 lg:order-2">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('all.Contact Information') }}</h3>
                <form wire:submit.prevent="placeOrder" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-6">
                        <label for="type"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Order Type') }}</label>
                        <select wire:model.live="type" id="type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="takeaway">{{ __('all.Takeaway') }}</option>
                            <option value="inplace">{{ __('all.In Place') }}</option>
                            <option value="delivery">{{ __('all.Delivery') }}</option>
                        </select>
                        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Name') }}</label>
                        <input type="text" wire:model="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Phone') }}</label>
                        <input type="text" wire:model="phone" id="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    @if($type === 'inplace')
                        <div class="sm:col-span-6">
                            <label for="table_number"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Table Number') }}</label>
                            <input type="text" wire:model="table_number" id="table_number"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('table_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    @if($type === 'delivery')
                        <div class="sm:col-span-6">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Address') }}</label>
                            <textarea wire:model="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="sm:col-span-6">
                        <label for="note"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Note (Optional)') }}</label>
                        <textarea wire:model="note" id="note" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>

                    <div class="sm:col-span-6">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            {{ __('all.Place Order') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

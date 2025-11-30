<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                {{ __('all.Our Menu') }}
            </h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                {{ __('all.Delicious meals prepared just for you.') }}
            </p>
        </div>

        <!-- Categories Filter -->
        <div class="mt-10 flex justify-center space-x-4 overflow-x-auto py-4">
            <button wire:click="filterCategory(null)"
                class="px-4 py-2 rounded-full text-sm font-medium {{ is_null($activeCategory) ? 'bg-orange-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} shadow-sm transition-colors duration-200">
                {{ __('all.All') }}
            </button>
            @foreach($categories as $category)
                <button wire:click="filterCategory({{ $category->id }})"
                    class="px-4 py-2 rounded-full text-sm font-medium {{ $activeCategory == $category->id ? 'bg-orange-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} shadow-sm transition-colors duration-200">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img class="h-48 w-full object-cover"
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.svg') }}"
                        alt="{{ $product->name }}">
                    <div class="p-6">
                        <div class="flex justify-between items-baseline">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                            <span class="text-lg font-bold text-orange-600">{{ $product->price }} DH</span>
                        </div>
                        <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                            {{ $product->description }}
                        </p>
                        <div class="mt-4">
                            <button wire:click="addToCart({{ $product->id }})"
                                class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                {{ __('all.Add to Cart') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div>
    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-50"
                src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                alt="Restaurant Background">
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                {{ __('all.Welcome to RestauApp') }}
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                {{ __('all.Experience the best dining with our exquisite menu and lovely atmosphere.') }}
            </p>
            <div class="mt-10">
                <a href="{{ route('menu') }}" wire:navigate
                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                    {{ __('all.View Menu') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Menu CTA Section -->
    <div class="bg-white dark:bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                {{ __('all.Discover Our Menu') }}
            </h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                {{ __('all.From appetizers to desserts, we have something for everyone.') }}
            </p>
            <div class="mt-8">
                <a href="{{ route('menu') }}" wire:navigate
                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-orange-600 bg-orange-100 hover:bg-orange-200">
                    {{ __('all.Browse Full Menu') }}
                </a>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                        {{ __('all.About Us') }}
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg text-gray-500 dark:text-gray-300">
                        {{ __('all.We are passionate about food and providing the best experience for our customers. Our chefs use only the freshest ingredients to create mouth-watering dishes.') }}
                    </p>
                </div>
                <div class="mt-8 lg:mt-0">
                    <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                        <img class="object-cover shadow-lg rounded-lg"
                            src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                            alt="About Us">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservation Section -->
    <div class="bg-white dark:bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white sm:text-4xl mb-8">
                {{ __('all.Book a Table') }}
            </h2>
            <div class="max-w-lg mx-auto">
                <form wire:submit.prevent="bookTable" class="grid grid-cols-1 gap-y-6">
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Name') }}</label>
                        <input type="text" wire:model="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Email') }}</label>
                        <input type="email" wire:model="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Phone') }}</label>
                        <input type="text" wire:model="phone" id="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Date') }}</label>
                            <input type="date" wire:model="date" id="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="time"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Time') }}</label>
                            <input type="time" wire:model="time" id="time"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="guests"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Number of Guests') }}</label>
                        <input type="number" wire:model="guests" id="guests" min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('guests') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            {{ __('all.Book Now') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white sm:text-4xl mb-8">
                {{ __('all.Gallery') }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 1">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 2">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 3">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 4">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 5">
                <img class="h-64 w-full object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Food 6">
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-white dark:bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white sm:text-4xl mb-8">
                {{ __('all.Contact Us') }}
            </h2>
            <div class="h-96 w-full bg-gray-300 rounded-lg overflow-hidden">
                <!-- Embedded Google Map Placeholder -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98513058459375!3d40.74881717932847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1629783019435!5m2!1sen!2sus"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>

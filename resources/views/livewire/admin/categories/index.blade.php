<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Categories') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Organize your menu items') }}</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-x-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-amber-500/30 hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ __('all.Create New Category') }}
        </button>
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

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($categories as $category)
            <div class="relative group rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <!-- Category Image -->
                <div class="aspect-w-16 aspect-h-9 h-40 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover">
                    @else
                        <div class="flex items-center justify-center h-40">
                            <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Category Info -->
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $category->slug }}</p>
                        </div>
                        @if($category->is_active)
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                {{ __('all.Active') }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 dark:bg-red-900/50 px-2.5 py-1 text-xs font-medium text-red-700 dark:text-red-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                {{ __('all.Inactive') }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="mt-4 flex items-center gap-3">
                        <button wire:click="edit({{ $category->id }})" class="flex-1 inline-flex justify-center items-center gap-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            {{ __('all.Edit') }}
                        </button>
                        <button wire:click="delete({{ $category->id }})" onclick="confirm('{{ __('all.Are you sure?') }}') || event.stopImmediatePropagation()" class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-500 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25z" />
                    </svg>
                    <h3 class="mt-4 text-sm font-semibold text-gray-900 dark:text-white">{{ __('all.No categories yet') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Get started by creating a new category') }}</p>
                    <button wire:click="create" class="mt-4 inline-flex items-center gap-x-2 px-4 py-2 text-sm font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('all.Create New Category') }}
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity" wire:click="closeModal"></div>
                <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
                <div class="inline-block w-full transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left align-bottom shadow-xl transition-all sm:my-8 sm:max-w-lg sm:align-middle">
                    <div class="px-6 pt-6 pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $categoryId ? __('all.Edit Category') : __('all.Create Category') }}
                            </h3>
                            <button wire:click="closeModal" class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <form class="space-y-4">
                            <!-- Names -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }} (EN)</label>
                                    <input type="text" wire:model="name_en" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                    @error('name_en') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }} (FR)</label>
                                    <input type="text" wire:model="name_fr" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                    @error('name_fr') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }} (AR)</label>
                                    <input type="text" wire:model="name_ar" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" dir="rtl">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }} (ES)</label>
                                    <input type="text" wire:model="name_es" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                </div>
                            </div>

                            <!-- Slug -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Slug') }}</label>
                                <input type="text" wire:model="slug" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" placeholder="category-slug">
                                @error('slug') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Image') }}</label>
                                <input type="file" wire:model="image" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 dark:file:bg-amber-900/50 dark:file:text-amber-400">
                                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center gap-3">
                                <input type="checkbox" wire:model="is_active" id="is_active" class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-amber-600 focus:ring-amber-500 dark:bg-gray-700">
                                <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('all.Active') }}</label>
                            </div>
                        </form>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3">
                        <button wire:click.prevent="{{ $categoryId ? 'update' : 'store' }}" type="button" class="inline-flex justify-center rounded-xl border border-transparent bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                            {{ $categoryId ? __('all.Update') : __('all.Create') }}
                        </button>
                        <button wire:click="closeModal" type="button" class="inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            {{ __('all.Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
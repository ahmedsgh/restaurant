<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Users Management') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Manage staff and admin accounts') }}</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-x-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ __('all.Create New User') }}
        </button>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="rounded-xl bg-green-50 dark:bg-green-900/30 p-4 ring-1 ring-green-200 dark:ring-green-800">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium text-green-800 dark:text-green-300">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="rounded-xl bg-red-50 dark:bg-red-900/30 p-4 ring-1 ring-red-200 dark:ring-red-800">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <p class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Search & Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('all.Search users...') }}" class="block w-full pl-10 pr-3 py-2.5 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-amber-500 focus:ring-amber-500 text-sm">
        </div>
    </div>

    <!-- Users Table -->
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.User') }}</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.Email') }}</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.Role') }}</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.Status') }}</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.Joined') }}</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('all.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-sm font-bold text-white">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                                            @if($user->id === auth()->id())
                                                <span class="inline-flex items-center rounded-md bg-amber-100 dark:bg-amber-900/50 px-1.5 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400">
                                                    {{ __('all.You') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->roles->first())
                                        @php $role = $user->roles->first(); @endphp
                                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-medium
                                            @if($role->name === 'Super Admin') bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-400
                                            @elseif($role->name === 'Admin') bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-400
                                            @elseif($role->name === 'Manager') bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-400
                                            @else bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300
                                            @endif">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                            </svg>
                                            {{ $role->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-lg bg-gray-100 dark:bg-gray-700 px-2.5 py-1 text-xs font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('all.No Role') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                            {{ __('all.Verified') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 dark:bg-yellow-900/50 px-2.5 py-1 text-xs font-medium text-yellow-700 dark:text-yellow-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                            {{ __('all.Unverified') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $user->id }})" class="p-2 text-gray-500 hover:text-amber-600 dark:text-gray-400 dark:hover:text-amber-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="{{ __('all.Edit') }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        @if($user->id !== auth()->id())
                                            <button wire:click="delete({{ $user->id }})" wire:confirm="{{ __('all.Are you sure you want to delete this user?') }}" class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="{{ __('all.Delete') }}">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @else
            <div class="px-6 py-16 text-center">
                <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ __('all.No users yet') }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ __('all.Get started by creating a new user') }}</p>
                <button wire:click="create" class="inline-flex items-center gap-x-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('all.Create New User') }}
                </button>
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($isOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900/75 transition-opacity" wire:click="closeModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full ring-1 ring-gray-900/5 dark:ring-gray-700">
                    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $userId ? __('all.Edit User') : __('all.Create User') }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-6 py-5 space-y-5">
                        <form wire:submit.prevent="{{ $userId ? 'update' : 'store' }}">
                            <!-- Name -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Name') }}</label>
                                <input type="text" wire:model="name" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Email') }}</label>
                                <input type="email" wire:model="email" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                @error('email') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    {{ __('all.Password') }}
                                    @if($userId)
                                        <span class="text-xs text-gray-500 dark:text-gray-400">({{ __('all.Leave blank to keep current password') }})</span>
                                    @endif
                                </label>
                                <input type="password" wire:model="password" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                @error('password') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Confirm Password') }}</label>
                                <input type="password" wire:model="password_confirmation" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                @error('password_confirmation') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Role') }}</label>
                                <select wire:model="selectedRole" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500">
                                    <option value="">{{ __('all.Select Role') }}</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedRole') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>
                        </form>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3">
                        <button wire:click.prevent="{{ $userId ? 'update' : 'store' }}" type="button" class="inline-flex justify-center rounded-xl border border-transparent bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                            {{ $userId ? __('all.Update') : __('all.Create') }}
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

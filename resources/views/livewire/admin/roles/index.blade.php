<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Roles') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Manage user roles and permissions') }}</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-x-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-amber-500/30 hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ __('all.Create New Role') }}
        </button>
    </div>

    <!-- Messages -->
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

    @if (session()->has('error'))
        <div class="rounded-xl bg-red-50 dark:bg-red-900/50 p-4 ring-1 ring-red-200 dark:ring-red-800">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Roles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($roles as $role)
            <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 rounded-xl flex items-center justify-center
                                @if($role->name === 'Super Admin') bg-gradient-to-br from-purple-500 to-indigo-600
                                @elseif($role->name === 'Admin') bg-gradient-to-br from-amber-500 to-orange-600
                                @elseif($role->name === 'Manager') bg-gradient-to-br from-blue-500 to-cyan-600
                                @else bg-gradient-to-br from-gray-500 to-gray-600
                                @endif">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $role->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $role->permissions->count() }} {{ __('all.permissions') }}
                                </p>
                            </div>
                        </div>
                        @if($role->name !== 'Super Admin')
                            <div class="flex items-center gap-1">
                                <button wire:click="edit({{ $role->id }})" class="p-2 text-gray-500 hover:text-amber-600 dark:text-gray-400 dark:hover:text-amber-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="{{ __('all.Edit') }}">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $role->id }})" onclick="confirm('{{ __('all.Are you sure?') }}') || event.stopImmediatePropagation()" class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="{{ __('all.Delete') }}">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <span class="inline-flex items-center rounded-full bg-purple-100 dark:bg-purple-900/50 px-2.5 py-1 text-xs font-medium text-purple-700 dark:text-purple-400">
                                {{ __('all.Protected') }}
                            </span>
                        @endif
                    </div>

                    <!-- Permissions Preview -->
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">{{ __('all.Permissions') }}</p>
                        <div class="flex flex-wrap gap-1">
                            @foreach($role->permissions->take(6) as $permission)
                                <span class="inline-flex items-center rounded-md bg-gray-100 dark:bg-gray-700 px-2 py-0.5 text-xs font-medium text-gray-600 dark:text-gray-300">
                                    {{ str_replace('_', ' ', $permission->name) }}
                                </span>
                            @endforeach
                            @if($role->permissions->count() > 6)
                                <span class="inline-flex items-center rounded-md bg-amber-100 dark:bg-amber-900/50 px-2 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400">
                                    +{{ $role->permissions->count() - 6 }} {{ __('all.more') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Users Count -->
                    <div class="mt-4 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span>{{ $role->users()->count() }} {{ __('all.users') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <p class="mt-4 text-sm font-medium text-gray-900 dark:text-white">{{ __('all.No roles yet') }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Get started by creating a new role') }}</p>
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
                <div class="inline-block w-full transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left align-bottom shadow-xl transition-all sm:my-8 sm:max-w-2xl sm:align-middle">
                    <div class="px-6 pt-6 pb-4">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $roleId ? __('all.Edit Role') : __('all.Create Role') }}
                            </h3>
                            <button wire:click="closeModal" class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <form class="space-y-6">
                            <!-- Role Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('all.Role Name') }}</label>
                                <input type="text" wire:model="name" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-amber-500 focus:ring-amber-500" placeholder="{{ __('all.Enter role name') }}">
                                @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Permissions -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('all.Permissions') }}</label>
                                <div class="max-h-[40vh] overflow-y-auto space-y-4 pr-2">
                                    @foreach($permissions as $module => $modulePermissions)
                                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                                            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 flex items-center justify-between">
                                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 capitalize">{{ __('all.' . $module) }}</span>
                                                <button type="button" wire:click="toggleAllPermissions('{{ $module }}')" class="text-xs font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">
                                                    {{ __('all.Toggle All') }}
                                                </button>
                                            </div>
                                            <div class="p-4 grid grid-cols-2 gap-3">
                                                @foreach($modulePermissions as $permission)
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}" class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-amber-600 focus:ring-amber-500 dark:bg-gray-700">
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ str_replace('_', ' ', ucfirst(explode('_', $permission->name)[0])) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3">
                        <button wire:click.prevent="{{ $roleId ? 'update' : 'store' }}" type="button" class="inline-flex justify-center rounded-xl border border-transparent bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                            {{ $roleId ? __('all.Update') : __('all.Create') }}
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

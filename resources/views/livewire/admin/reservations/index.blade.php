<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('all.Reservations Management') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Manage table reservations and bookings') }}</p>
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

    <!-- Reservations Table -->
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Guest') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Contact') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Date & Time') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Party Size') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ __('all.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($reservation->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $reservation->name }}</p>
                                        @if($reservation->special_requests)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[150px]" title="{{ $reservation->special_requests }}">{{ $reservation->special_requests }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-900 dark:text-white">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                        {{ $reservation->email }}
                                    </div>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                        </svg>
                                        {{ $reservation->phone }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/50">
                                        <svg class="h-5 w-5 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($reservation->time)->format('h:i A') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $reservation->guests }}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('all.guests') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusConfig = [
                                        'pending' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/50', 'text' => 'text-yellow-700 dark:text-yellow-400', 'dot' => 'bg-yellow-500'],
                                        'confirmed' => ['bg' => 'bg-green-100 dark:bg-green-900/50', 'text' => 'text-green-700 dark:text-green-400', 'dot' => 'bg-green-500'],
                                        'cancelled' => ['bg' => 'bg-red-100 dark:bg-red-900/50', 'text' => 'text-red-700 dark:text-red-400', 'dot' => 'bg-red-500'],
                                    ];
                                    $config = $statusConfig[$reservation->status] ?? $statusConfig['pending'];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full {{ $config['bg'] }} px-2.5 py-1 text-xs font-medium {{ $config['text'] }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    @if($reservation->status == 'pending')
                                        <button wire:click="updateStatus({{ $reservation->id }}, 'confirmed')" class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors" title="{{ __('all.Confirm') }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                            {{ __('all.Confirm') }}
                                        </button>
                                        <button wire:click="updateStatus({{ $reservation->id }}, 'cancelled')" class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-700 dark:text-red-400 bg-red-100 dark:bg-red-900/30 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors" title="{{ __('all.Cancel') }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            {{ __('all.Cancel') }}
                                        </button>
                                    @endif
                                    <button wire:click="delete({{ $reservation->id }})" onclick="confirm('{{ __('all.Are you sure?') }}') || event.stopImmediatePropagation()" class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="{{ __('all.Delete') }}">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                                <h3 class="mt-4 text-sm font-semibold text-gray-900 dark:text-white">{{ __('all.No reservations yet') }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('all.Reservations will appear here when customers book tables') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-semibold mb-6">{{ __('all.Orders Management') }}</h2>

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('all.Tracking Code') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('all.Customer') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('all.Type') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Total</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($orders as $order)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $order->tracking_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $order->customer_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ ucfirst($order->type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        ${{ $order->total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status == 'preparing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status == 'ready' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status == 'completed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="viewOrder({{ $order->id }})"
                                            class="text-indigo-600 hover:text-indigo-900">{{ __('all.View') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($selectedOrder)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('all.Order Details') }} -
                            {{ $selectedOrder->tracking_code }}</h3>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400"><strong>{{ __('all.Customer') }}:</strong>
                                {{ $selectedOrder->customer_name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><strong>{{ __('all.Phone') }}:</strong>
                                {{ $selectedOrder->customer_phone ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Type:</strong>
                                {{ ucfirst($selectedOrder->type) }}</p>
                            @if($selectedOrder->type == 'delivery')
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>{{ __('all.Address') }}:</strong>
                                    {{ $selectedOrder->customer_address }}</p>
                            @endif
                            @if($selectedOrder->type == 'inplace')
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>{{ __('all.Table') }}:</strong>
                                    {{ $selectedOrder->table_number }}</p>
                            @endif
                            @if($selectedOrder->note)
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>{{ __('all.Note') }}:</strong>
                                    {{ $selectedOrder->note }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">{{ __('all.Items') }}:</h4>
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($selectedOrder->items as $item)
                                    <li class="py-2 flex justify-between">
                                        <span class="text-sm text-gray-900 dark:text-white">{{ $item->product->name }}
                                            x{{ $item->quantity }}</span>
                                        <span
                                            class="text-sm text-gray-900 dark:text-white">${{ $item->price * $item->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div
                                class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-700 flex justify-between font-bold">
                                <span class="text-gray-900 dark:text-white">{{ __('all.Total') }}:</span>
                                <span class="text-gray-900 dark:text-white">${{ $selectedOrder->total }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update
                                Status:</label>
                            <div class="flex space-x-2">
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'pending')"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">{{ __('all.Pending') }}</button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'preparing')"
                                    class="px-3 py-1 bg-blue-500 text-white rounded text-sm">{{ __('all.Preparing') }}</button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'ready')"
                                    class="px-3 py-1 bg-green-500 text-white rounded text-sm">{{ __('all.Ready') }}</button>
                                <button wire:click="updateStatus({{ $selectedOrder->id }}, 'completed')"
                                    class="px-3 py-1 bg-gray-500 text-white rounded text-sm">{{ __('all.Completed') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="closeModal"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


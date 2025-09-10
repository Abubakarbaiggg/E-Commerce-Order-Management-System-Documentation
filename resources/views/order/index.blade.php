<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border border-gray-200 shadow-md rounded-lg">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3 border-b">#</th>
                                    <th class="px-6 py-3 border-b">User</th>
                                    <th class="px-6 py-3 border-b">Product</th>
                                    <th class="px-6 py-3 border-b">Amount</th>
                                    <th class="px-6 py-3 border-b">Qunatity</th>
                                    <th class="px-6 py-3 border-b">Status</th>
                                    <th class="px-6 py-3 border-b">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($orders as $order)
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">{{ $i++ }}</td>
                                        <td class="px-6 py-4 border-b">{{ $order->user->name }}</td>
                                        <td class="px-6 py-4 border-b">{{ $order->product->name }}</td>
                                        <td class="px-6 py-4 border-b">{{ $order->product->price }}</td>
                                        <td class="px-6 py-4 border-b">{{ $order->quantity }}</td>
                                        <td class="px-6 py-4 border-b">{{ $order->status }}</td>
                                        <td class="px-6 py-4 border-b">
                                            {{ number_format($order->product->price * $order->quantity, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Orders') }}
                </h2>
                <div>
                    <a href="{{ route('product.index') }}"
                        class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                        Back
                    </a>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            @if (session('success'))
                                <div class="p-4 mb-4 text-sm text-green-700 bg-white border border-green-300 rounded-lg shadow-sm"
                                    role="alert">
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            @endif
                            <table class="w-full text-sm text-left border border-gray-200 shadow-md rounded-lg">
                                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                    <tr>
                                        <th class="px-6 py-3 border-b">#</th>
                                        <th class="px-6 py-3 border-b">Image</th>
                                        <th class="px-6 py-3 border-b">Name</th>
                                        <th class="px-6 py-3 border-b">Price</th>
                                        <th class="px-6 py-3 border-b">Stock</th>
                                        <th class="px-6 py-3 border-b">Status</th>
                                        <th class="px-6 py-3 border-b">Total Price</th>
                                        <th class="px-6 py-3 border-b text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($orders as $order)
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 border-b">{{ $i++ }}</td>
                                            <td class="px-6 py-4 border-b"><img
                                                    src="{{ asset('images/' . $order->product->image) }}" width="70px"
                                                    height="70px"></td>
                                            <td class="px-6 py-4 border-b">{{ $order->product->name }}</td>
                                            <td class="px-6 py-4 border-b">{{ $order->product->price }}</td>
                                            <td class="px-6 py-4 border-b">{{ $order->quantity }}</td>
                                            <td class="px-6 py-4 border-b">{{ $order->status }}</td>
                                            <td class="px-6 py-4 border-b">
                                                {{ number_format($order->quantity * $order->product->price, 2, '.', ',') }}
                                            </td>
                                            <td class="px-6 py-4 border-b">
                                                <div class="flex justify-center space-x-2">
                                                 <a href="{{ route('order.edit', $order->id) }}"
                                                        class="bg-transparent hover:bg-neutral-500 text-neutral-700  hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                <form action="{{ route('order.destroy', $order->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $orders->links('pagination::tailwind') }}
                            </div>
                            {{-- <form action="{{ route('payment.process') }}" method="POST" class="flex items-end gap-4 mt-4">
                                @csrf
                                <div class="flex-1">
                                    <label for="total_price" class="block mb-2 text-sm font-medium text-gray-900">Total
                                        Price</label>
                                    <input type="text" name="total_price" id="total_price"
                                        value="{{ $total_price }}"
                                        class="bg-gray-50 border border-gary-300 text-gray-900 text-sm rounded-lg focus:ring-blue-50 focus:border-blue-500 block w-full p-2.5"
                                        readonly>
                                </div>
                                <div class="flex-1">
                                    <label for="payment_method"
                                        class="block mb-2 text-sm font-medium text-gray-900">Payment Method</label>
                                    <select name="payment_method" id="payment_method"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                        <option value="" disabled selected>Select Payment Method</option>
                                        <option value="easypaisa">EasyPaisa</option>
                                        <option value="jazzcash">JazzCash</option>
                                        <option value="card">Credit/Debit Card</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="submit"
                                        class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                        Proceed to Payment
                                    </button>
                                </div>
                            </form> --}}
                            <form action="{{ route('payment.process') }}" method="POST" class="flex items-end gap-4 mt-4">
                                @csrf
                                <div class="flex-1">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Total
                                        Price</label>
                                    <input type="text" name="price" id="name" value="{{ $total_price }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter product name" required readonly>
                                </div>
                                <div class="col-2">
                                    <button
                                        class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                        Payment Card
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

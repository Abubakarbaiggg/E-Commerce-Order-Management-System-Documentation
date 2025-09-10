<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buy Product') }}
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">

                <!-- Product Image -->
                <div class="h-64 w-full bg-cover bg-center rounded-t-xl"
                    style="background-image: url('{{ asset('images/' . $order->image) }}')">
                </div>

                <!-- Product Details -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $order->name }}</h3>
                    <p class="text-gray-700 text-base mb-4">{{ $order->description }}</p>

                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-semibold text-green-700">💲 {{ number_format($order->price) }}</p>
                        <p class="text-sm text-gray-500">Stock Available: {{ $order->stock }}</p>
                    </div>
                    <!-- Buy Form -->
                        <form action="{{ route('order.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_amount" value="{{ $order->price }}">
                        <div class="flex gap-6 mb-4">
                            <!-- Quantity Input -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Select Quantity</label>
                                <input type="number" name="quantity" id="quantity" min="1"
                                    max="{{ $order->stock }}" value="1"
                                    class="mt-1 block w-28 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Product Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Product Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-32 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="Completed">Completed</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
                            <i class="fa-solid fa-cart-shopping"></i> Buy Now
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

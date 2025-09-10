<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
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
                    style="background-image: url('{{ asset('images/' . $product->image) }}')">
                </div>

                <!-- Product Details -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $product->name }}</h3>
                    <p class="text-gray-700 text-base mb-4">{{ $product->description }}</p>

                    <div class="flex justify-between items-center mb-2">
                        <p class="text-lg font-semibold text-green-700">💲 {{ number_format($product->price) }}</p>
                        <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

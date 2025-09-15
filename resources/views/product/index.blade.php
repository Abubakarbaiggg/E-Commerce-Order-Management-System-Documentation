    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Products') }}
                </h2>
                @can('Product view')
                    <div>
                        <a href="{{ route('product.create') }}"
                            class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                            Add Product
                        </a>
                    </div>
                @endcan
            </div>
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
                                        <th class="px-6 py-3 border-b">Image</th>
                                        <th class="px-6 py-3 border-b">Name</th>
                                        <th class="px-6 py-3 border-b">Price</th>
                                        <th class="px-6 py-3 border-b">Stock</th>
                                        <th class="px-6 py-3 border-b text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($products as $product)
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 border-b">{{ $i++ }}</td>
                                            <td class="px-6 py-4 border-b"><img
                                                    src="{{ asset('images/' . $product->image) }}" width="70px"
                                                    height="70px"></td>
                                            <td class="px-6 py-4 border-b">{{ $product->name }}</td>
                                            <td class="px-6 py-4 border-b">{{ $product->price }}</td>
                                            <td class="px-6 py-4 border-b">{{ $product->stock }}</td>
                                            <td class="px-6 py-4 border-b">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('order.show', $product->id) }}"
                                                        class="bg-transparent hover:bg-teal-500 text-teal-700 hover:text-white font-semibold py-2 px-4 border border-teal-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </a>
                                                    <a href="{{ route('product.show', $product->id) }}"
                                                        class="bg-transparent hover:bg-slate-500 text-slate-700 hover:text-white font-semibold py-2 px-4 border border-slate-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    @can('Product edit')
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="bg-transparent hover:bg-neutral-500 text-neutral-700  hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    @endcan
                                                    @can('Product delete')
                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Users') }}
                </h2>
                <div>
                    <a href="{{ route('product.create') }}"
                        class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                        Add Product
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
                                        <th class="px-6 py-3 border-b">Name</th>
                                        <th class="px-6 py-3 border-b">Email</th>
                                        <th class="px-6 py-3 border-b text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($users as $user)
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 border-b">{{ $i++ }}</td>
                                            <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                                            <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                                            <td class="px-6 py-4 border-b">
                                                <div class="flex justify-center space-x-2">
                                                    <label for="roles-modal-{{ $user->id }}" class="bg-transparent hover:bg-neutral-500 text-neutral-700 hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-user-shield mr-1"></i>
                                                    </label>
                                                    <input type="checkbox" id="roles-modal-{{ $user->id }}" class="peer hidden">
                                                    <div class="fixed inset-0 bg-black bg-opacity-50 hidden peer-checked:flex justify-center items-center z-50">
                                                        <div class="bg-white w-full max-w-lg p-6 rounded-2xl shadow-lg relative animate-fadeIn">
                                                            <label for="roles-modal-{{ $user->id }}" class="absolute top-3 right-4 text-gray-500 hover:text-gray-800 cursor-pointer text-2xl">&times;</label>
                                                            <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2"> Assign Role to {{ $user->name }}</h2>
                                                            <form action="" method="POST" class="space-y-3">
                                                            @csrf
                                                            <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto p-2">
                                                                @foreach ($roles as $role)
                                                                    <label class="flex items-center space-x-2">
                                                                        <input type="checkbox" name="roles[]"
                                                                            value="{{ $role->id }}"
                                                                            class="rounded text-indigo-600 focus:ring-indigo-500"
                                                                            @if ($user->roles->contains($role->id)) checked @endif>
                                                                        <span
                                                                            class="text-gray-700">{{ $role->name }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                            <div class="flex justify-end space-x-3 pt-4 border-t">
                                                                <button type="submit" class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded"> Submit </button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('product.edit', $user->id) }}"
                                                        class="bg-transparent hover:bg-neutral-500 text-neutral-700  hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('product.destroy', $user->id) }}"
                                                        method="post">
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
                                {{-- {{ $users->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

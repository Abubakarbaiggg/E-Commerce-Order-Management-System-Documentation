    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Users') }}
                </h2>
                <div>
                    <a href="{{ route('product.create') }}"
                        class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                        Add Product</a>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                          {{-- ya par tha wo alert --}}
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
                                                <div class="flex justify-center items-center space-x-2">
                                                    <!-- Assign Role Modal -->
                                                    <x-show-modal :id="'roles-modal-'.$user->id" :title="'Assign Role to ' . $user->name" :action="route('assignRolesToUser', $user->id)">
                                                        <x-slot name="trigger">
                                                            <i class="fa-solid fa-user-tag mr-1"></i>
                                                        </x-slot>
                                                        @foreach ($roles as $role)
                                                            <label class="flex items-center space-x-2">
                                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{$user->roles->contains($role->id) ? 'checked' : ''}} class="rounded text-indigo-600 focus:ring-indigo-500">
                                                                <span class="text-gray-700">{{ $role->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </x-show-modal>

                                                    <!-- Assign Permission Modal -->
                                                        <x-show-modal :id="'permissions-modal-'.$user->id" :title="'Assign Permission to '.$user->name" :action="route('assignPermissionsToUser', $user->id)">
                                                        <x-slot name="trigger">
                                                            <i class="fa-solid fa-key mr-1"></i>
                                                        </x-slot>
                                                        @foreach ($permissions as $permission)
                                                            <label class="flex items-center space-x-2">
                                                                <input type="checkbox" name="permissions[]" {{$user->permissions->contains($permission->id) ? 'checked' : ''}} value="{{ $permission->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                                                <span class="text-gray-700">{{ $permission->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </x-show-modal>

                                                    <!-- Edit -->
                                                    <a href="{{ route('product.edit', $user->id) }}" class="bg-transparent hover:bg-neutral-500 text-neutral-700 hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('product.destroy', $user->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
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

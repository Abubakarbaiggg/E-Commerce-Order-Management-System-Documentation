    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Roles') }}
                </h2>
                {{-- @can('Role create') --}}
                    <div>
                        <a href="{{ route('role.create') }}"
                            class="bg-transparent hover:bg-neutral-500 text-neutral-700 font-semibold hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                            Add Role
                        </a>
                    </div>
                {{-- @endcan --}}
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
                                        <th class="px-6 py-3 border-b">Name</th>
                                        <th class="px-6 py-3 border-b text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($roles as $role)
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 border-b">{{ $i++ }}</td>
                                            <td class="px-6 py-4 border-b">{{ $role->name }}</td>
                                            <td class="px-6 py-4 border-b">
                                                <div class="flex justify-center items-center  space-x-2">
                                                    <!-- Assign Permission Modal -->
                                                        <x-show-modal :id="'permissions-modal-'.$role->id" :title="'Assign Permission to '.$role->name" :action="route('addPermissionToRole')">
                                                        <x-slot name="trigger">
                                                            <i class="fa-solid fa-user-check"></i>
                                                        </x-slot>
                                                        @foreach ($permissions as $permission)
                                                            <label class="flex items-center space-x-2">
                                                                <input type="checkbox" name="permissions[]" {{$role->permissions->contains($permission->id) ? 'checked' : ''}} value="{{ $permission->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                                                <span class="text-gray-700">{{ $permission->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </x-show-modal>
                                                    {{-- @can('Role edit') --}}
                                                        <a href="{{ route('role.edit', $role->id) }}"
                                                            class="bg-transparent hover:bg-neutral-500 text-neutral-700  hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('Role delete') --}}
                                                        <form action="{{ route('role.destroy', $role->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    {{-- @endcan --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{-- {{ $products->links('pagination::tailwind') }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

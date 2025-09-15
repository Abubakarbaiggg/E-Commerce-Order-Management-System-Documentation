@props(['id', 'title', 'action'])

<div class="inline-block">
    <label for="{{ $id }}"
        {{ $attributes->merge(['class' => 'bg-transparent hover:bg-neutral-500 text-neutral-700 hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded cursor-pointer']) }}>
        {{ $trigger ?? '' }}
    </label>

    <!-- Hidden Checkbox -->
    <input type="checkbox" id="{{ $id }}" class="peer hidden">

    <!-- Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden peer-checked:flex justify-center items-center z-50">
        <div class="bg-white w-full max-w-3xl max-h-[90vh] p-6 rounded-2xl shadow-lg relative animate-fadeIn flex flex-col">
            <!-- Close -->
            <label for="{{ $id }}"
                class="absolute top-3 right-4 text-gray-500 hover:text-gray-800 cursor-pointer text-2xl">&times;</label>

            <!-- Title -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">{{ $title ?? '' }}</h2>

            <!-- Form -->
            <form action="{{ $action ?? ''}}" method="POST" class="flex flex-col flex-1">
                @csrf
                <!-- Scrollable Content -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-3 overflow-y-auto flex-1 p-2">
                    {{ $slot }}
                </div>
                <!-- Footer -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="submit" class="bg-transparent hover:bg-neutral-500 text-neutral-700 hover:text-white py-2 px-4 border border-neutral-500 hover:border-transparent rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

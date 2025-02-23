<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Create Tag') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Campo de Nombre del Tag -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tag Name') }}
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="block w-full mt-1 p-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                       required placeholder="{{ __('Enter tag name') }}">
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.tags.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    ← {{ __('Cancel') }}
                </a>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                    ➕ {{ __('Create Tag') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

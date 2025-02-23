<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Update Category Information') }}
        </h3>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold text-gray-700 dark:text-gray-300">
                    {{ __('Name') }}
                </label>
                <input type="text" name="name" value="{{ $category->name }}" required
                       class="w-full mt-1 p-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.categories.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                    {{ __('Cancel') }}
                </a>

                <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Fill the details to create a new category') }}
        </h3>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Category Name') }}
                </label>
                <input type="text" name="name" id="name"
                       class="block w-full mt-1 p-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
                       required placeholder="{{ __('Enter category name') }}">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

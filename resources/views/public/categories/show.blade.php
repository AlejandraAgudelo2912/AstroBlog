<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Category Name') }}:
        </h3>
        <p class="text-xl font-bold text-indigo-700 dark:text-indigo-300 mt-2">
            {{ $category->name }}
        </p>

        @if ($category->description)
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-4">
                {{ __('Description') }}:
            </h3>
            <p class="text-gray-600 dark:text-gray-300">
                {{ $category->description }}
            </p>
        @endif

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('categories.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md">
                {{ __('Back to Categories') }}
            </a>
        </div>
    </div>
</x-blog-layout>

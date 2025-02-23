<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Available Categories') }}
        </h3>

        <ul class="space-y-3">
            @foreach ($categories as $category)
                <li class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200">
                    <a href="{{ route('categories.show', $category) }}" class="text-indigo-600 dark:text-indigo-300 font-semibold text-lg hover:underline">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-blog-layout>

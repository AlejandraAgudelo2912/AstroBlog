<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">
            {{ __('Browse by Category') }}
        </h3>

        @if($categories->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center">
                {{ __('No categories available.') }}
            </p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($categories as $category)
                    <li class="bg-indigo-100 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:bg-indigo-200 dark:hover:bg-gray-600 transition">
                        <a href="{{ route('user.categories.show', $category) }}" class="text-indigo-700 dark:text-indigo-300 font-semibold text-lg">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-blog-layout>

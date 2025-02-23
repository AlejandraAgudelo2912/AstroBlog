<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-xl font-semibold text-indigo-700 dark:text-indigo-300">
            {{ $category->name }}
        </h3>

        @if ($category->description)
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                {{ $category->description }}
            </p>
        @else
            <p class="mt-2 text-gray-500 dark:text-gray-400 italic">
                {{ __('No description available for this category.') }}
            </p>
        @endif

        @if ($category->posts->count())
            <h4 class="mt-6 text-lg font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Posts in this category') }}
            </h4>
            <ul class="mt-3 space-y-3">
                @foreach ($category->posts as $post)
                    <li class="p-4 bg-indigo-100 dark:bg-gray-700 rounded-lg shadow-md hover:bg-indigo-200 dark:hover:bg-gray-600 transition">
                        <a href="{{ route('user.posts.show', $post->slug) }}" class="text-indigo-700 dark:text-indigo-300 font-semibold">
                            {{ $post->title }}
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $post->created_at->format('d M, Y') }}
                        </p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-6 text-gray-500 dark:text-gray-400">
                {{ __('No posts available in this category.') }}
            </p>
        @endif
    </div>

    <div class="max-w-4xl mx-auto mt-4">
        <a href="{{ route('user.categories.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md">
            {{ __('Back to Categories') }}
        </a>
    </div>
</x-blog-layout>

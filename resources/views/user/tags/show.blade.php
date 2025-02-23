<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tag Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Tag Name') }}:
        </h3>

        <p class="text-indigo-600 dark:text-indigo-300 text-xl font-bold p-3 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
            #{{ $tag->name }}
        </p>

        <div class="mt-6">
            <a href="{{ route('user.tags.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md">
                {{ __('Back to Tags') }}
            </a>
        </div>
    </div>
</x-blog-layout>

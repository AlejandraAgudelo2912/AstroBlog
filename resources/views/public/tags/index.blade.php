<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        @if ($tags->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-lg text-center">
                {{ __('No tags available.') }}
            </p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}"
                       class="bg-indigo-500 hover:bg-indigo-700 text-white text-center text-lg font-semibold py-2 px-4 rounded-lg shadow-md transition">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-blog-layout>

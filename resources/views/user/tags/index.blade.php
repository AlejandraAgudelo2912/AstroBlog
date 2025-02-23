<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Available Tags') }}
        </h3>

        @if($tags->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 italic">
                {{ __('No tags available.') }}
            </p>
        @else
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <span class="bg-indigo-500 text-white text-sm px-3 py-1 rounded-full shadow-md hover:bg-indigo-600 transition">
                        <a href="{{ route('user.tags.show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    </span>
                @endforeach
            </div>
        @endif
    </div>
</x-blog-layout>

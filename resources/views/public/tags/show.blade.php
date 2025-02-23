<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Tag Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 text-center">
            #{{ $tag->name }}
        </h1>

        @if($tag->posts->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center mt-4">
                {{ __('No posts associated with this tag.') }}
            </p>
        @else
            <h2 class="text-xl font-semibold mt-6">{{ __('Related Posts') }}</h2>
            <ul class="mt-4 space-y-3">
                @foreach ($tag->posts as $post)
                    <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow-md">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 text-lg font-semibold hover:underline">
                            {{ $post->title }}
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Published on') }}: {{ $post->created_at->format('d M, Y') }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="max-w-4xl mx-auto mt-6 text-center">
        <a href="{{ route('tags.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
            {{ __('Back to Tags') }}
        </a>
    </div>
</x-blog-layout>

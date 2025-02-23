<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Comment') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-bold text-indigo-700 dark:text-indigo-300 mb-4">
            {{ __('Editing comment by') }}: {{ $comment->user->name }}
        </h3>

        <form action="{{ route('user.posts.comments.update', [$post, $comment]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Comment Title') }}</label>
                <input type="text" name="title" id="title" value="{{ old('title', $comment->title) }}" class="w-full mt-1 p-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label for="body" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Comment Body') }}</label>
                <textarea name="body" id="body" rows="5" class="w-full mt-1 p-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" required>{{ old('body', $comment->body) }}</textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('user.posts.comments.show', [$post, $comment]) }}" class="bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                    {{ __('Cancel') }}
                </a>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                    {{ __('Update Comment') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

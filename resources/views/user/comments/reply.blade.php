<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reply to Comment') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h3 class="text-lg font-bold text-indigo-700 dark:text-indigo-300 mb-4">
            {{ __('Replying to') }}: {{ $comment->title ?? __('Comment') }}
        </h3>

        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow mb-6">
            <p class="text-gray-700 dark:text-gray-300">
                "{{ $comment->body }}"
            </p>
            <p class="text-sm text-gray-500 mt-2">
                {{ __('By') }} <strong>{{ $comment->user->name }}</strong> | {{ $comment->created_at->diffForHumans() }}
            </p>
        </div>

        <form action="{{ route('user.posts.comments.reply', ['post' => $post, 'comment' => $comment]) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Comment Title') }}</label>
                <input type="text" name="title" id="title" class="w-full mt-1 p-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label for="body" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Comment Body') }}</label>
                <textarea name="body" id="body" rows="5" class="w-full mt-1 p-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" required></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                    {{ __('Reply') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

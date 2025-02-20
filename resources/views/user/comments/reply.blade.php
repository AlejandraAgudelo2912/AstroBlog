<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reply to Comment') }}
        </h2>
    </x-slot>
    <form action="{{ route('posts.comments.reply', ['post' => $post, 'comment' => $comment]) }}" method="POST">
        @csrf
        <div>
            <label for="title">{{ __('Comment Title') }}</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="body">{{ __('Comment Body') }}</label>
            <textarea name="body" id="body" rows="5" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">{{ __('Reply') }}</button>
    </form>
</x-blog-layout>

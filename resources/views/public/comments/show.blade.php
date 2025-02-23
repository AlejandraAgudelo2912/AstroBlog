<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comment Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <div class="flex items-center space-x-4">
            <img src="{{ $comment->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $comment->user->name }}" class="w-12 h-12 rounded-full shadow-md">
            <div>
                <h3 class="text-lg font-bold text-indigo-700 dark:text-indigo-300">
                    {{ $comment->user->name }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    {{ __('Posted on') }} {{ $comment->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <p class="mt-4 text-gray-800 dark:text-gray-300">
            {{ $comment->body }}
        </p>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('user.posts.comments.replied', ['post' => $post, 'comment' => $comment]) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md">
                {{ __('Reply') }}
            </a>

            <a href="{{ route('posts.show', $post) }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-md shadow-md">
                {{ __('Back to Post') }}
            </a>
        </div>
    </div>

    @if($comment->children->count())
        <div class="max-w-4xl mx-auto mt-6 bg-gray-100 dark:bg-gray-900 shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ __('Replies') }}</h3>

            @foreach($comment->children as $reply)
                <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md border-l-4 border-indigo-400">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $reply->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $reply->user->name }}" class="w-10 h-10 rounded-full shadow">
                        <div>
                            <h4 class="text-md font-bold text-indigo-600 dark:text-indigo-300">
                                {{ $reply->user->name }}
                            </h4>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('Replied on') }} {{ $reply->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    <p class="mt-3 text-gray-700 dark:text-gray-300">{{ $reply->body }}</p>
                </div>
            @endforeach
        </div>
    @endif
</x-blog-layout>

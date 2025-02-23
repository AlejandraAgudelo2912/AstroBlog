<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comment') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
            <div class="flex items-start space-x-4">
                <img class="w-12 h-12 rounded-full object-cover"
                     src="{{ $comment->user->profile_photo_url ?? asset('images/default-avatar.png') }}"
                     alt="{{ $comment->user->name }}">

                <div class="w-full">
                    <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300">
                        {{ $comment->user->name }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">
                        {{ $comment->body }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>

                    <a href="{{ route('user.posts.comments.replied', ['post' => $post, 'comment' => $comment]) }}"
                       class="inline-block mt-3 bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-md">
                        {{ __('Reply') }}
                    </a>
                </div>
            </div>

            @if($comment->children->count())
                <div class="mt-6 ml-8 border-l-4 border-gray-300 dark:border-gray-600 pl-4">
                    <h4 class="text-md font-semibold text-gray-600 dark:text-gray-400">
                        {{ __('Replies') }}
                    </h4>

                    @foreach($comment->children as $reply)
                        <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <div class="flex items-start space-x-4">
                                <img class="w-10 h-10 rounded-full object-cover"
                                     src="{{ $reply->user->profile_photo_url ?? asset('images/default-avatar.png') }}"
                                     alt="{{ $reply->user->name }}">

                                <div>
                                    <h5 class="text-md font-semibold text-indigo-700 dark:text-indigo-300">
                                        {{ $reply->user->name }}
                                    </h5>
                                    <p class="text-gray-700 dark:text-gray-300">
                                        {{ $reply->body }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-blog-layout>

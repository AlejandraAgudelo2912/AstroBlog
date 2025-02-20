<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $comment->user->name }}:
                    {{ $comment->body }}

                    <a href=" {{ route('posts.comments.replied', ['post' => $post, 'comment' => $comment]) }}" class="text-blue-500">{{__('Reply')}}</a>

                    @if($comment->children->count())
                        <div class="ml-6 border-l-2 pl-3">
                            @foreach($comment->children as $reply)
                                <div class="mt-2">
                                    <strong>{{ $reply->user->name }}</strong> {{ __('replied') }}:
                                    <p>{{ $reply->body }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-blog-layout>

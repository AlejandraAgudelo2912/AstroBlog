<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">{{ $post->title }}</h1>
        <p class="mt-3 text-gray-700 dark:text-gray-300">{{ $post->body }}</p>

        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-64 object-cover rounded-lg shadow-md">
        @endif

        @livewire('like-button', ['post' => $post])


        @if($post->user_id === auth()->id())
            <div class="mt-4 flex space-x-4">
                <a href="{{ route('admin.posts.edit', $post) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    {{__('Edit')}}
                </a>
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md" onclick="return confirm('{{__('¿Seguro que deseas eliminar esta publicación?')}}')">
                        {{__('Delete')}}
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="max-w-4xl mx-auto mt-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Comments') }}</h2>

        @auth
            <a href="{{ route('admin.posts.comments.create', ['post' => $post->slug]) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-md">
                {{ __('Add a Comment') }}
            </a>
        @else
            <p class="text-red-500 mt-2">{{ __('You must') }} <a href="{{ route('login') }}" class="underline">{{ __('login') }}</a> {{ __('to add a comment.') }}</p>
        @endauth

        @foreach ($post->comments as $comment)
            <div class="bg-gray-100 dark:bg-gray-700 shadow-lg rounded-lg p-4 mt-4">
                <p><strong class="text-indigo-700 dark:text-indigo-300">{{ $comment->user->name }}:</strong> {{ $comment->body }}</p>

                <div class="flex items-center mt-2 space-x-2">
                    <a href="{{ route('admin.posts.comments.show', ['post' => $post, 'comment' => $comment]) }}" class="text-blue-500 hover:underline">
                        {{__('Show details')}}
                    </a>

                    @if(auth()->id() === $comment->user_id)
                        <a href="{{ route('admin.posts.comments.edit',  ['post' => $post, 'comment' => $comment]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded-md shadow-md">
                            {{__('Edit')}}
                        </a>

                        <form action="{{ route('admin.posts.comments.destroy',  ['post' => $post, 'comment' => $comment]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded-md shadow-md" onclick="return confirm('{{__('¿Seguro que deseas eliminar este comentario?')}}')">
                                {{__('Delete')}}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-blog-layout>

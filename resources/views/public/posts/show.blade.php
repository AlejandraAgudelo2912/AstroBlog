<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        {{-- Título del Post --}}
        <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">{{ $post->title }}</h1>

        {{-- Información del Autor y Fecha --}}
        <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm">
            {{ __('Published on') }} {{ $post->created_at->format('d M Y') }}
            {{ __('by') }}
            <a href="{{ route('user.profile', $post->user) }}" class="text-indigo-500 hover:underline">
                {{ $post->user->name }}
            </a>
        </p>

        {{-- Imagen destacada si está disponible --}}
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg shadow-md mt-4">
        @endif

        {{-- Contenido del Post --}}
        <p class="mt-4 text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ $post->body }}
        </p>

        {{-- Sección de Tags --}}
        <div class="mt-4">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Tags') }}:</span>
            @forelse ($post->tags as $tag)
                <span class="bg-indigo-500 text-white text-xs px-3 py-1 rounded-full mr-2">
                    {{ $tag->name }}
                </span>
            @empty
                <span class="text-gray-500 dark:text-gray-400 text-sm">{{ __('No tags') }}</span>
            @endforelse
        </div>

        {{-- Botón de Like --}}
        <div class="mt-4">
            @livewire('like-button', ['post' => $post])
        </div>
    </div>

    {{-- Sección de Comentarios --}}
    <div class="max-w-4xl mx-auto mt-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Comments') }}</h2>

        {{-- Mensaje para usuarios no autenticados --}}
        @guest
            <p class="text-red-500 mt-2">
                {{ __('You must') }}
                <a href="{{ route('login') }}" class="underline text-blue-500">{{ __('login') }}</a>
                {{ __('to add a comment.') }}
            </p>
        @endguest

        {{-- Lista de Comentarios --}}
        @forelse ($post->comments as $comment)
            <div class="bg-gray-100 dark:bg-gray-700 shadow-lg rounded-lg p-4 mt-4">
                {{-- Nombre del usuario y contenido del comentario --}}
                <p><strong class="text-indigo-700 dark:text-indigo-300">{{ $comment->user->name }}:</strong> {{ $comment->body }}</p>

                <div class="flex items-center mt-2 space-x-2">
                    {{-- Enlace a detalles del comentario --}}
                    <a href="{{ route('posts.comments.show', ['post' => $post, 'comment' => $comment]) }}" class="text-blue-500 hover:underline">
                        {{__('Show details')}}
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400 mt-2">{{ __('No comments yet.') }}</p>
        @endforelse
    </div>
</x-blog-layout>

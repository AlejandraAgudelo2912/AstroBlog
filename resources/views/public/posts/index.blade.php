<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Latest Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

                {{-- Imagen de portada si está disponible --}}
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @else
                    <img src="{{ asset('images/default-post.jpg') }}" alt="{{ __('Default Image') }}" class="w-full h-48 object-cover">
                @endif

                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-indigo-700 dark:text-indigo-300">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">
                            {{ $post->title }}
                        </a>
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm">
                        {{ __('Published on') }} {{ $post->created_at->format('d M Y') }}
                        {{ __('by') }}
                        <a href="{{ route('user.profile', $post->user) }}" class="text-indigo-500 hover:underline">
                            {{ $post->user->name }}
                        </a>
                    </p>

                    <p class="mt-3 text-gray-800 dark:text-gray-200 text-sm">
                        {{ Str::limit($post->body, 120, '...') }}
                    </p>

                    {{-- Tags --}}
                    <div class="mt-4">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{__('Tags')}}:</span>
                        @forelse ($post->tags as $tag)
                            <span class="bg-indigo-500 text-white text-xs px-3 py-1 rounded-full mr-2">
                                {{ $tag->name }}
                            </span>
                        @empty
                            <span class="text-gray-500 dark:text-gray-400 text-sm">{{ __('No tags') }}</span>
                        @endforelse
                    </div>

                    {{-- Botón Ver Más --}}
                    <div class="mt-4">
                        <a href="{{ route('posts.show', $post->slug) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            {{ __('Read More') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Paginación --}}
    <div class="mt-8 flex justify-center">
        {{ $posts->links() }}
    </div>
</x-blog-layout>

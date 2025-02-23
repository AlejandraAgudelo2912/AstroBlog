<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 space-y-6">
        @forelse($posts as $post)
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
                {{-- Título del post --}}
                <h3 class="text-2xl font-semibold text-indigo-700 dark:text-indigo-300">
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h3>

                {{-- Información del post --}}
                <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                    {{ __('Published on') }} {{ $post->created_at->format('d M Y') }}
                    - <span class="font-semibold">{{ $post->status }}</span>
                </p>

                {{-- Descripción del post --}}
                <p class="mt-3 text-gray-800 dark:text-gray-200 text-sm">
                    {{ Str::limit($post->body, 120, '...') }}
                </p>

                {{-- Etiquetas --}}
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

                {{-- Botones de acciones --}}
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        {{__('Edit')}}
                    </a>

                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md" onclick="return confirm('{{__('Are you sure you want to delete this post?')}}')">
                            🗑 {{__('Delete')}}
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('No posts found.') }}</p>
        @endforelse
    </div>
</x-blog-layout>

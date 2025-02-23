<x-blog-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-center">
            {{ __('Posts de') }} {{ $user->name }}
        </h1>

        @if($posts->isEmpty())
            <p class="text-gray-600 dark:text-gray-400 text-center mt-4">
                {{ __('Este usuario no ha publicado ningún post.') }}
            </p>
        @else
            <div class="mt-6 space-y-4">
                @foreach ($posts as $post)
                    <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">{{ $post->title }}</p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('Publicado el') }} {{ $post->created_at->format('d M, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-blog-layout>

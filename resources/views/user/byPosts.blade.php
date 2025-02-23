<x-blog-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold">Posts de {{ $user->name }}</h1>

        @if($posts->isEmpty())
            <p class="text-gray-600">Este usuario no ha publicado ningún post.</p>
        @else
            <ul class="mt-4">
                @foreach ($posts as $post)
                    <li class="mb-3 border-b pb-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 text-lg font-semibold">
                            {{ $post->title }}
                        </a>
                        <p class="text-sm text-gray-500">Publicado el {{ $post->created_at->format('d M, Y') }}</p>
                    </li>
                @endforeach
            </ul>

            {{ $posts->links() }}
        @endif
    </div>
</x-blog-layout>

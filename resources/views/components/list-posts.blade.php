<div class="max-w-6xl mx-auto mt-6 space-y-6">
    @foreach($posts as $post)
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">

            @if ($post->cover_image)
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Cover Image"
                     class="w-full h-48 object-cover rounded-lg mb-4">
            @endif

            <h3 class="text-2xl font-semibold text-indigo-700 dark:text-indigo-300">
                <a href="{{ route('admin.posts.show', $post->slug) }}" class="hover:underline">
                    {{ $post->title }}
                </a>
            </h3>

            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                {{ __('By') }} <span class="font-semibold">{{ $post->user->name }}</span>
                | {{ $post->created_at->format('d M Y') }}
            </p>

            <p class="mt-3 text-gray-800 dark:text-gray-200">
                {{ Str::limit($post->body, 150, '...') }}
            </p>

            @if ($post->tags->isNotEmpty())
                <div class="mt-4">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{__('Tags')}}:</span>
                    @foreach ($post->tags as $tag)
                        <span class="bg-indigo-500 text-white text-xs px-3 py-1 rounded-full mr-2">
                                {{ $tag->name }}
                            </span>
                    @endforeach
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.posts.show', $post->slug) }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                    {{ __('See more') }}
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8 flex justify-center space-x-4">
    <a href="{{ route('admin.posts.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
        {{ __('Create Post') }}
    </a>

    <a href="{{ route('admin.posts.my') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
        {{ __('My Posts') }}
    </a>
</div>

<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-indigo-500">
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}"
                       class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                       required>
            </div>

            <div>
                <label for="body" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Body') }}</label>
                <textarea name="body" id="body" rows="6"
                          class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                          required>{{ $post->body }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Status') }}</label>
                <select name="status" id="status"
                        class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                    <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                    <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                    <option value="archived" {{ $post->status === 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                </select>
            </div>

            <div>
                <label for="published_at" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Publish Date') }}</label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $post->published_at ) }}"
                       class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="visibility" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Visibility') }}</label>
                <select name="visibility" id="visibility"
                        class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                    <option value="public" {{ $post->visibility === 'public' ? 'selected' : '' }}>{{ __('Public') }}</option>
                    <option value="private" {{ $post->visibility === 'private' ? 'selected' : '' }}>{{ __('Private') }}</option>
                </select>
            </div>

            <div>
                <label for="cover_image" class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Cover Image') }}</label>
                <input type="file" name="cover_image" id="cover_image"
                       class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">

                @if($post->cover_image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Current Cover Image:') }}</p>
                        <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>
            <div>
                <label class="block text-lg font-semibold text-gray-700 dark:text-gray-200">{{ __('Tags') }}</label>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2 bg-indigo-100 dark:bg-indigo-800 text-indigo-900 dark:text-indigo-300 px-3 py-1 rounded-full shadow-sm">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ __('Select multiple tags if needed.') }}</p>
            </div>


            <div class="flex justify-between mt-4">
                <a href="{{ route('posts.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

<div>
    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Comment Title') }}</label>
    <input
        type="text"
        name="title"
        id="title"
        value="{{ old('title', $comment->title ?? '') }}"
        required
        class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
    >
</div>

<div class="mt-4">
    <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Comment Body') }}</label>
    <textarea
        name="body"
        id="body"
        rows="5"
        required
        class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
    >{{ old('body', $comment->body ?? '') }}</textarea>
</div>

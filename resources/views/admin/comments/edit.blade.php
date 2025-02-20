<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a Comment') }}
        </h2>
    </x-slot>
    <form action="{{ route('admin.posts.comments.update', [$post, $comment]) }}" method="POST">
        @include('admin.comments.form-fields')
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">{{ __('Update Comment') }}</button>
        @csrf
        @method('PUT')
    </form>
</x-blog-layout>

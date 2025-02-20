<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comments for') }} {{ $post->title }}
        </h2>
    </x-slot>
    <ul>
        @foreach ($comments as $comment)
            <li>{{ $comment->body }}</li>
        @endforeach
    </ul>
</x-blog-layout>

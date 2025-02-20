<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{__('Tags')}}</h2>
    </x-slot>
    <ul class="mt-4">
        @foreach ($tags as $tag)
            <li class="border-b py-2">
                <a href="{{ route('tags.show', $tag) }}" class="text-blue-500">
                    {{ $tag->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-blog-layout>

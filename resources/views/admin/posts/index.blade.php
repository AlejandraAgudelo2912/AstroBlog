<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    @include('components.list-posts')

</x-blog-layout>

<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Post List') }}
        </h2>
    </x-slot>

    @livewire('post-list')
</x-blog-layout>

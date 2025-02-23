<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Image of the Day') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">{{ $data['title'] }}</h2>

        <div class="mt-4">
            <img src="{{ $data['url'] }}" alt="{{ $data['title'] }}"
                 class="mx-auto w-full max-h-[500px] object-cover rounded-lg shadow-lg transition-transform transform hover:scale-105">
        </div>

        <p class="mt-4 text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
            {{ $data['explanation'] }}
        </p>
    </div>
</x-blog-layout>

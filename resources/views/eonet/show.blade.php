<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ $event['title'] }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="border-b pb-4">
            <p class="text-lg text-gray-700 dark:text-gray-300">
                <span class="font-semibold">{{ __('Date') }}:</span>
                {{ \Carbon\Carbon::parse($event['geometry'][0]['date'])->format('d-m-Y') }}
            </p>
            <p class="mt-4 text-gray-600 dark:text-gray-300">
                {{ $event['description'] ?? __('No description available.') }}
            </p>
        </div>

        @if(isset($event['sources'][0]['url']))
            <div class="mt-6">
                <a href="{{ $event['sources'][0]['url'] }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    {{ __('Source') }}
                </a>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('eonet.index') }}" class="text-blue-500 hover:underline">
                ← {{ __('Back to events') }}
            </a>
        </div>
    </div>
</x-blog-layout>

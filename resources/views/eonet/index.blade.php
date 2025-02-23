<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <ul class="space-y-6">
            @foreach ($events['events'] as $event)
                <li class="border-b pb-6">
                    <h3 class="font-bold text-2xl text-indigo-700 dark:text-indigo-300">
                        {{ $event['title'] }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        <span class="font-semibold">{{ __('Date') }}:</span>
                        {{ \Carbon\Carbon::parse($event['geometry'][0]['date'])->format('d-m-Y') }}
                    </p>
                    <p class="mt-3 text-gray-700 dark:text-gray-200">
                        {{ $event['description'] ?? __('No description available.') }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('eonet.show', $event['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                            {{ __('See more') }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-blog-layout>

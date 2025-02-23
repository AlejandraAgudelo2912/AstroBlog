<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Near Earth Objects') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <ul class="space-y-6">
            @foreach ($data['near_earth_objects'] as $date => $asteroids)
                <li class="border-b pb-6">
                    <h3 class="font-bold text-2xl text-indigo-700 dark:text-indigo-300">{{ __('Date') }}: {{ $date }}</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach ($asteroids as $asteroid)
                            <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $asteroid['name'] }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    <span class="font-semibold">{{ __('Diameter') }}:</span>
                                    {{ round($asteroid['estimated_diameter']['meters']['estimated_diameter_max'], 2) }}m
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</x-blog-layout>

<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white border-b border-gray-200">

        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300 mb-4">
                {{ __('Featured Posts') }}
            </h2>

            @forelse($topPosts as $post)
                <div class="mb-4 p-4 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ Str::limit($post->body, 100) }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">{{ __('No featured posts available.') }}</p>
            @endforelse
        </div>
        <hr>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ $apod['url'] }}" alt="Astronomy Picture" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="font-bold text-xl">{{ $apod['title'] }}</h2>
                    <p class="text-gray-600 mt-2">{{ \Carbon\Carbon::parse($apod['date'])->format('d-m-Y') }}</p>
                    <a href="{{ route('nasa.picture') }}" class="text-blue-500 mt-4 inline-block">{{__('See more')}}</a>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-4">
                <h2 class="font-bold text-xl">{{__('Events')}}</h2>
                <ul class="mt-4">
                    @foreach ($events as $event)
                        <li class="mt-2">
                            <strong>{{ $event['title'] }}</strong> - {{ \Carbon\Carbon::parse($event['geometry'][0]['date'])->format('d-m-Y') }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('eonet.index') }}" class="text-blue-500 mt-4 inline-block">{{__('All events')}}</a>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-4">
                <h2 class="font-bold text-xl">{{__('Asteroids')}}</h2>
                <ul class="mt-4">
                    @foreach ($asteroids as $date => $asteroidList)
                        @foreach ($asteroidList as $asteroid)
                            <li class="mt-2">
                                <strong>{{ $asteroid['name'] }}</strong> - {{__('Diameter')}}: {{ round($asteroid['estimated_diameter']['meters']['estimated_diameter_max'], 2) }}m
                            </li>
                        @endforeach
                    @endforeach
                </ul>
                <a href="{{ route('nasa.asteroids') }}" class="text-blue-500 mt-4 inline-block">{{__('All asteroids')}}</a>
            </div>

        </div>
    </div>
</x-blog-layout>

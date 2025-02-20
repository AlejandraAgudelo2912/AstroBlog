<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>

    <div id="map" style="height: 500px;" class="rounded-lg shadow-lg"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        window.mapPoints = @json($points);
    </script>

    <script src="{{ asset('js/map.js') }}"></script>
</x-blog-layout>

<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>

    <div id="map" style="height: 500px;" class="rounded-lg shadow-lg"></div>

    @auth
        <div class="mt-6 p-4 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-bold mb-2">{{__('Add Observation')}}</h2>
            <form action="{{ route('user.map.store') }}" method="POST">
                @csrf
                <label for="name" class="block font-medium">{{__('Name')}}:</label>
                <input type="text" name="name" class="w-full p-2 border rounded mb-2" required>

                <label for="description" class="block font-medium">{{__('Description')}}:</label>
                <textarea name="description" class="w-full p-2 border rounded mb-2"></textarea>

                <label for="latitude" class="block font-medium">{{__('Latitude')}}:</label>
                <input type="text" name="latitude" id="latitude" class="w-full p-2 border rounded mb-2" required>

                <label for="longitude" class="block font-medium">{{__('Longitude')}}:</label>
                <input type="text" name="longitude" id="longitude" class="w-full p-2 border rounded mb-2" required>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{__('Add Observation')}}</button>
            </form>
        </div>
    @endauth

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        window.mapPoints = @json($points);
    </script>

    <script src="{{ asset('js/map.js') }}"></script>
</x-blog-layout>

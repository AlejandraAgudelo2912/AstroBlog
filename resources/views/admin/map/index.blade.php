<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Interactive Map') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 space-y-6">
        <!-- Contenedor del mapa -->
        <div id="map" class="w-full h-96 rounded-lg shadow-lg border border-gray-300 dark:border-gray-600"></div>

        <!-- Formulario de Livewire -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                {{ __('Add Observation Point') }}
            </h2>
            @livewire('observation-point-form')
        </div>
    </div>

    <!-- Carga de Leaflet y scripts -->
    <script>
        window.mapPoints = @json($points);
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
</x-blog-layout>

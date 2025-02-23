<div class="mt-6">
    @if (!$showForm)
        <button wire:click="showObservationForm"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
            {{ __('Add Observation') }}
        </button>
    @endif

    @if ($showForm)
        <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-4">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
                {{ __('Add Observation Point') }}
            </h2>

            @if (session()->has('message'))
                <p class="text-green-600 font-medium">{{ session('message') }}</p>
            @endif

            <form wire:submit.prevent="save" class="space-y-4">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}:</label>
                    <input type="text" wire:model="name"
                           class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}:</label>
                    <textarea wire:model="description"
                              class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <!-- Latitud -->
                <div>
                    <label for="latitude" class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Latitude') }}:</label>
                    <input type="text" wire:model="latitude" id="latitude"
                           class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('latitude') border-red-500 @enderror"
                           required>
                    @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Longitud -->
                <div>
                    <label for="longitude" class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Longitude') }}:</label>
                    <input type="text" wire:model="longitude" id="longitude"
                           class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('longitude') border-red-500 @enderror"
                           required>
                    @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-between mt-6">
                    <button wire:click="$dispatch('setCoordinates', { latitude: parseFloat(document.getElementById('latitude').value), longitude: parseFloat(document.getElementById('longitude').value) })"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                        {{ __('Save Observation') }}
                    </button>

                    <button type="button" wire:click="hideObservationForm"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>

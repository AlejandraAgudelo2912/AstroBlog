<div class="mt-6">
    @if (!$showForm)
        <button wire:click="showObservationForm" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ __('Add Observation') }}
        </button>
    @endif

    @if ($showForm)
        <div class="p-4 bg-white shadow-lg rounded-lg mt-4">
            <h2 class="text-xl font-bold mb-2">{{ __('Add Observation') }}</h2>

            @if (session()->has('message'))
                <p class="text-green-500">{{ session('message') }}</p>
            @endif

            <form wire:submit.prevent="save">
                <label for="name" class="block font-medium">{{ __('Name') }}:</label>
                <input type="text" wire:model="name" class="w-full p-2 border rounded mb-2" required>

                <label for="description" class="block font-medium">{{ __('Description') }}:</label>
                <textarea wire:model="description" class="w-full p-2 border rounded mb-2"></textarea>

                <label for="latitude" class="block font-medium">{{ __('Latitude') }}:</label>
                <input type="text" wire:model="latitude" id="latitude" class="w-full p-2 border rounded mb-2" required>

                <label for="longitude" class="block font-medium">{{ __('Longitude') }}:</label>
                <input type="text" wire:model="longitude" id="longitude" class="w-full p-2 border rounded mb-2" required>

                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ __('Save Observation') }}
                    </button>
                    <button type="button" wire:click="hideObservationForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>

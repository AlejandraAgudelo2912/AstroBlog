<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label for="email" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label for="roles" class="block font-semibold text-gray-700 dark:text-gray-300">{{ __('Roles') }}</label>
                <select name="roles[]" id="roles" multiple class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                <small class="text-gray-500 dark:text-gray-400">{{ __('Hold CTRL (CMD on Mac) to select multiple roles') }}</small>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-lg transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-lg transition">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
</x-blog-layout>

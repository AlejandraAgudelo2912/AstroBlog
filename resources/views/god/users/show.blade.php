<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6">
        <div class="flex items-center space-x-6">
            <div class="w-24 h-24 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-2xl font-bold text-gray-700 dark:text-gray-200">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-300">{{ $user->name }}</h3>
                <p class="text-gray-600 dark:text-gray-300"><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>{{ __('Joined on') }}:</strong> {{ $user->created_at->format('d M Y') }}</p>

                <p class="mt-2">
                    <strong class="text-gray-700 dark:text-gray-300">{{ __('Roles') }}:</strong>
                    @foreach ($user->roles as $role)
                        <span class="px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 dark:bg-indigo-700 dark:text-indigo-300 rounded-full">
                            {{ ucfirst($role->name) }}
                        </span>
                    @endforeach
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-lg transition">
                {{ __('Back to List') }}
            </a>
            <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-lg transition">
                {{ __('Edit User') }}
            </a>
            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-lg transition"
                        onclick="return confirm('{{ __('Are you sure you want to delete this user?') }}')">
                    {{ __('Delete User') }}
                </button>
            </form>
        </div>
    </div>
</x-blog-layout>

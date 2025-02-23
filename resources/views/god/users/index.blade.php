<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6">
        <table class="min-w-full border-collapse w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <thead>
            <tr class="bg-indigo-500 text-white text-left text-sm uppercase tracking-wider">
                <th class="py-3 px-6">{{ __('Name') }}</th>
                <th class="py-3 px-6">{{ __('Email') }}</th>
                <th class="py-3 px-6">{{ __('Role') }}</th>
                <th class="py-3 px-6 text-center">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <td class="py-4 px-6 text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                    <td class="py-4 px-6 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                    <td class="py-4 px-6 text-gray-800 dark:text-gray-200">
                            <span class="px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 dark:bg-indigo-700 dark:text-indigo-300 rounded-full">
                                {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('users.show', $user) }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline font-semibold mr-4">
                            {{ __('Show') }}
                        </a>
                        <a href="{{ route('users.edit', $user) }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="ml-4 text-red-600 dark:text-red-400 hover:underline font-semibold"
                                    onclick="return confirm('{{ __('Are you sure you want to delete this user?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-blog-layout>

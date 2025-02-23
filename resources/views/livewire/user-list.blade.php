<div class="max-w-6xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Users List') }}
        </h2>
        <a href="{{ route('admin.users.pdf') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition">
            📄 {{ __('Download PDF') }}
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
            <thead class="bg-gray-200 dark:bg-gray-900 text-gray-700 dark:text-gray-200">
            <tr class="text-left">
                <th class="px-6 py-3 text-lg">{{ __('Name') }}</th>
                <th class="px-6 py-3 text-lg">{{ __('Email') }}</th>
                <th class="px-6 py-3 text-lg">{{ __('Role') }}</th>
            </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
            @foreach ($users as $user)
                <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <td class="px-6 py-4 font-semibold">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                  {{ $user->hasRole('admin') ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $users->links() }}
    </div>
</div>

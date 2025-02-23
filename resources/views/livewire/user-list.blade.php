<div class="max-w-6xl mx-auto mt-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">{{ __('Users List') }}</h2>
    </div>

    <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">{{ __('Name') }}</th>
            <th class="px-4 py-2">{{ __('Email') }}</th>
            <th class="px-4 py-2">{{ __('Role') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">
                    {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.users.pdf') }}" class="bg-green-500 text-white px-3 py-1 rounded">
        {{ __('Download PDF') }}
    </a>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

<div class="max-w-6xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Posts Management') }}
        </h2>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-4 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
            <thead class="bg-gray-200 dark:bg-gray-900 text-gray-700 dark:text-gray-200">
            <tr class="text-left">
                <th class="px-6 py-3 text-lg">{{ __('Title') }}</th>
                <th class="px-6 py-3 text-lg">{{ __('Author') }}</th>
                <th class="px-6 py-3 text-lg">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
            @foreach ($posts as $post)
                <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <td class="px-6 py-4 font-semibold">
                        {{ $post->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->user->name }}
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        @if ($post->deleted_at)
                            {{-- Botones para eliminados --}}
                            <button wire:click="restore({{ $post->id }})"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                                {{ __('Restore') }}
                            </button>
                            <button wire:click="forceDelete({{ $post->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                                {{ __('Delete Forever') }}
                            </button>
                        @else
                            {{-- Botones para activos --}}
                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                                {{ __('Edit') }}
                            </a>
                            <button wire:click="delete({{ $post->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                                {{ __('Delete') }}
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>

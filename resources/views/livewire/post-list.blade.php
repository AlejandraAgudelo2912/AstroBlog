<div class="max-w-6xl mx-auto mt-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">{{ __('Posts') }}</h2>
        <button wire:click="toggleTrashed" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
            {{ $showTrashed ? __('Show Active Posts') : __('Show Deleted Posts') }}
        </button>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
        <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">{{ __('Title') }}</th>
            <th class="px-4 py-2">{{ __('Author') }}</th>
            <th class="px-4 py-2">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $post->title }}</td>
                <td class="px-4 py-2">{{ $post->user->name }}</td>
                <td class="px-4 py-2">
                    @if ($post->trashed())
                        <button wire:click="restore({{ $post->id }})" class="bg-green-500 text-white px-3 py-1 rounded">
                            {{ __('Restore') }}
                        </button>
                        <button wire:click="forceDelete({{ $post->id }})" class="bg-red-500 text-white px-3 py-1 rounded">
                            {{ __('Delete Forever') }}
                        </button>
                    @else
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">
                            {{ __('Edit') }}
                        </a>
                        <button wire:click="delete({{ $post }})" class="bg-red-500 text-white px-3 py-1 rounded">
                            {{ __('Delete') }}
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>

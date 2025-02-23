<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Tag Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300">{{ $tag->name }}</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-2">{{ __('Created at') }}: {{ $tag->created_at->format('d-m-Y H:i') }}</p>
        </div>

        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('admin.tags.edit', $tag) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold px-4 py-2 rounded-lg shadow-md transition">
                {{ __('Edit Tag') }}
            </a>

            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this tag?') }}');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-lg shadow-md transition">
                    {{ __('Delete Tag') }}
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.tags.index') }}"
               class="text-blue-500 hover:underline">
                ← {{ __('Back to Tags List') }}
            </a>
        </div>
    </div>
</x-blog-layout>

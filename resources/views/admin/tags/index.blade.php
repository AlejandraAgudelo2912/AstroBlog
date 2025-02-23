<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Tags Management') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300">{{ __('Tags List') }}</h3>
            <a href="{{ route('admin.tags.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                + {{ __('Create Tag') }}
            </a>
        </div>

        @if($tags->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('No tags available.') }}</p>
        @else
            <table class="w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">{{ __('Tag Name') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $tag->name }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.tags.show', $tag) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2 ">
                                {{ __('Show') }}
                            </a>
                            <a href="{{ route('admin.tags.edit', $tag) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-blog-layout>

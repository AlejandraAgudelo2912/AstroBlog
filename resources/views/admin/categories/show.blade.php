<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
            {{ __('Category Information') }}
        </h3>

        <div class="p-4 border rounded-lg bg-gray-100 dark:bg-gray-700">
            <p class="text-lg font-semibold text-gray-900 dark:text-gray-200">
                {{ __('Name') }}: <span class="font-normal">{{ $category->name }}</span>
            </p>
            <p class="text-lg font-semibold text-gray-900 dark:text-gray-200 mt-2">
                {{ __('Description') }}: <span class="font-normal">{{ $category->description ?? __('No description available') }}</span>
            </p>
            <p class="text-lg font-semibold text-gray-900 dark:text-gray-200 mt-2">
                {{ __('Created At') }}: <span class="font-normal">{{ $category->created_at->format('d M Y') }}</span>
            </p>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.categories.edit', $category) }}"
               class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                {{ __('Edit Category') }}
            </a>

            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                  onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</x-blog-layout>

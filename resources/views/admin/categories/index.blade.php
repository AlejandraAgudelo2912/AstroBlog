<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Category List') }}</h3>
            <a href="{{ route('admin.categories.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                {{ __('Create Category') }}
            </a>
        </div>

        @if ($categories->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center py-4">{{ __('No categories available.') }}</p>
        @else
            <div class="overflow-hidden border rounded-lg">
                <table class="min-w-full bg-white dark:bg-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                {{ $category->name }}
                            </td>
                            <td class="px-4 py-3 flex justify-center space-x-2">
                                <a href="{{ route('admin.categories.show', $category) }}"
                                   class="text-blue-500 hover:text-blue-700 font-semibold mr-2">
                                    {{ __('Show') }}
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-blue-500 hover:text-blue-700 font-semibold">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 font-semibold">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-blog-layout>

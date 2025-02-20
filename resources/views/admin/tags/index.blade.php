<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{__('Tags')}}</h2>
    </x-slot>

    <a href="{{ route('admin.tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">{{__('Create Tag')}}</a>

    <ul class="mt-4">
        @foreach ($tags as $tag)
            <li class="border-b py-2">
                {{ $tag->name }}
                <a href="{{ route('admin.tags.edit', $tag) }}" class="text-blue-500">{{__('Edit')}}</a>
                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">{{__('Delete')}}</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-blog-layout>

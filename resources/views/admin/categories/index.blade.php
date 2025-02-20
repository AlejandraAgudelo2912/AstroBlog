<x-blog-layout>
    <x-slot name="header">{{__('Categories')}}</x-slot>

    <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">{{__('Create Category')}}</a>

    <ul class="mt-4">
        @foreach ($categories as $category)
            <li class="border-b py-2">
                {{ $category->name }}
                <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500">{{__('Edit')}}</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">{{__('Delete')}}</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-blog-layout>

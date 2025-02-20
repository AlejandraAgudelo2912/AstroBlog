<x-blog-layout>
    <x-slot name="header">{{__('Categories')}}</x-slot>

    <ul class="mt-4">
        @foreach ($categories as $category)
            <li class="border-b py-2">
                <a href="{{ route('categories.show', $category) }}" class="text-blue-500">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-blog-layout>

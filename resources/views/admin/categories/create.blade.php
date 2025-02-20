<x-blog-layout>
    <x-slot name="header">{{__('Create Category')}}</x-slot>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label for="name">{{ __('Name')}}:</label>
        <input type="text" name="name" required class="border p-2 w-full">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">{{ __('Create')}}</button>
    </form>
</x-blog-layout>

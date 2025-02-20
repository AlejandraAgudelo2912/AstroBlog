<x-blog-layout>
    <x-slot name="header">{{__('Edit Category')}}</x-slot>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">{{ __('Name')}}:</label>
        <input type="text" name="name" value="{{ $category->name }}" required class="border p-2 w-full">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">{{ __('Update')}}</button>
    </form>
</x-blog-layout>

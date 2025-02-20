<x-blog-layout>
    <x-slot name="header">{{__('Edit Tag')}}</x-slot>

    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">{{ __('Name')}}:</label>
        <input type="text" name="name" value="{{ $tag->name }}" required class="border p-2 w-full">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">{{ __('Update')}}</button>
    </form>
</x-blog-layout>

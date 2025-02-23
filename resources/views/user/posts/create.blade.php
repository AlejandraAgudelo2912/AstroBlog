<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <form method="POST" action="{{ route('user.posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('components.post-form-fields')

            <div class="flex justify-end mt-6">
                <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Create Post') }}
                </x-button>
            </div>
        </form>
    </div>
</x-blog-layout>

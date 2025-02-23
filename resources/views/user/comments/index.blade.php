<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 space-y-4">
        @if ($comments->isEmpty())
            <p class="text-gray-500 text-center">{{ __('No comments available.') }}</p>
        @else
            <ul class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 divide-y divide-gray-300 dark:divide-gray-700">
                @foreach ($comments as $comment)
                    <li class="py-4">
                        <div class="flex items-start space-x-4">
                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $comment->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $comment->user->name }}">
                            <div>
                                <h3 class="text-md font-semibold text-indigo-600 dark:text-indigo-300">{{ $comment->user->name }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $comment->body }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-blog-layout>

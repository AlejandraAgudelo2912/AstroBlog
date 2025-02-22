<div class="flex items-center mt-4">
    <button wire:click="toggleLike" class="flex items-center focus:outline-none">
        @guest
            <a href="{{ route('login') }}">
                <x-heart-unlike class="w-6 h-6 text-gray-500" />
            </a>
        @elseguest
            @if($liked)
                <x-heart-like class="w-6 h-6 text-red-500" />
            @else
                <x-heart-unlike class="w-6 h-6 text-gray-500" />
            @endif
        @endguest
        <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $likes }} {{ __('Likes') }}</span>
    </button>
</div>

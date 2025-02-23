<div class="relative" wire:poll.5s="loadNotifications">
    <button wire:click="toggleDropdown" class="relative">
        <img src=" {{ asset('images/bell.png') }}" alt="Notificaciones" class="w-6 h-6">
        @if($notifications->count() > 0)
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full -mt-2 -mr-3">
                {{ $notifications->count() }}
            </span>
        @endif
    </button>

    @if($showDropdown)
        <div class="absolute border-2 border-indigo-600 top-10 right-0 mt-3 w-80 bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden z-50 animate-fade-in">
            {{-- Encabezado --}}
            <div class="bg-indigo-600 text-white px-4 py-2 flex justify-between items-center">
                <h3 class="text-lg font-semibold">{{ __('Your Notifications') }}</h3>
                <button wire:click="markAllAsRead" class="text-sm underline hover:text-gray-200">
                    {{ __('Mark All as Read') }}
                </button>
            </div>

            {{-- Contenido de Notificaciones --}}
            <div class="max-h-60 overflow-y-auto p-3">
                @if ($notifications->isEmpty())
                    <p class="text-gray-500 text-center py-4">{{ __('No notifications') }}</p>
                @else
                    <ul class="space-y-3">
                        @foreach ($notifications as $notification)
                            <li class="p-3 border rounded-lg flex justify-between items-center {{ $notification->read_at ? 'bg-gray-100 dark:bg-gray-700' : 'bg-blue-50 dark:bg-gray-800' }}">
                                <div>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $notification->data['message'] }}</p>
                                    <small class="text-gray-500 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                @if (!$notification->read_at)
                                    <button wire:click="markAsRead('{{ $notification->id }}')" class="text-xs text-indigo-600 hover:text-indigo-800 underline">
                                        {{ __('Read') }}
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
</div>

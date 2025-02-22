<div class="relative" wire:poll.5s="loadNotifications">
    <button wire:click="toggleDropdown" class="relative">
        🔔
        @if($notifications->count() > 0)
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                {{ $notifications->count() }}
            </span>
        @endif
    </button>

    @if($showDropdown)
        <div class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg p-4">
            <h3 class="text-lg font-bold mb-2">Tus Notificaciones</h3>

            @if ($notifications->isEmpty())
                <p class="text-gray-500">No tienes notificaciones.</p>
            @else
                <ul>
                    @foreach ($notifications as $notification)
                        <li class="mb-3 p-3 border rounded bg-blue-100">
                            <p>{{ $notification->data['message'] }}</p>
                            @if (!$notification->read_at)
                                <button wire:click="markAsRead('{{ $notification->id }}')" class="ml-4 text-sm text-gray-600 underline">
                                    Marcar como leída
                                </button>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <button wire:click="markAllAsRead" class="mt-2 text-blue-500 underline">
                    Marcar todas como leídas
                </button>
            @endif
        </div>
    @endif
</div>

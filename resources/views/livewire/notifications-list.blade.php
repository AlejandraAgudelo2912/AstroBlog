<div class="max-w-4xl mx-auto mt-6 bg-white shadow-lg rounded-lg p-6">
    <h3 class="text-lg font-bold mb-4">Tus Notificaciones</h3>

    @if ($notifications->isEmpty())
        <p class="text-gray-500">No tienes notificaciones.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li class="mb-3 p-3 border rounded {{ $notification->read_at ? 'bg-gray-200' : 'bg-blue-100' }}">
                    <p>{{ $notification->data['message'] }}</p>
                    <a href="{{ url('/posts/' . $notification->data['post_id']) }}" class="text-blue-500 underline">
                        {{__('Show Post')}}
                    </a>

                    @if (!$notification->read_at)
                        <button wire:click="markAsRead('{{ $notification->id }}')" class="ml-4 text-sm text-gray-600 underline">
                            Marcar como leída
                        </button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

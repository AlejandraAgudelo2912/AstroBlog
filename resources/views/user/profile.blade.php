<x-blog-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>

        <div class="mt-4">
            <h2 class="text-xl font-semibold">Información</h2>
            <p>Email: {{ $user->email }}</p>
            <p>Miembro desde: {{ $user->created_at->format('d M, Y') }}</p>
        </div>

        <div class="mt-4">
            <h2 class="text-xl font-semibold">Estadísticas</h2>
            <p>Publicaciones: {{ $user->posts_count }}</p>
            <p>Comentarios: {{ $user->comments_count }}</p>
            <p>Última conexión: {{ $user->last_login_at ? $user->last_login_at->format('d M, Y H:i') : 'Nunca' }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('user.byPosts', $user) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Ver Publicaciones
            </a>
        </div>
    </div>
</x-blog-layout>

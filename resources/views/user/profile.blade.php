<x-blog-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="text-center">
            <!-- Foto de perfil -->
            <div class="flex justify-center">
                <img src="{{ $user->profile_photo_url ?? asset('images/default-avatar.png') }}"
                     alt="{{ $user->name }}"
                     class="w-32 h-32 rounded-full border-4 border-indigo-500 shadow-md">
            </div>

            <h1 class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-gray-200">{{ $user->name }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('Miembro desde') }}: {{ $user->created_at->format('d M, Y') }}</p>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Información del usuario -->
            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">{{ __('Información') }}</h2>
                <p class="mt-2 text-gray-700 dark:text-gray-400"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="text-gray-700 dark:text-gray-400"><strong>Última conexión:</strong> {{ $user->last_login_at ? $user->last_login_at->format('d M, Y H:i') : __('Nunca') }}</p>
            </div>

            <!-- Estadísticas del usuario -->
            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">{{ __('Estadísticas') }}</h2>
                <p class="mt-2 text-gray-700 dark:text-gray-400"><strong>{{ __('Publicaciones') }}:</strong> {{ $user->posts_count }}</p>
                <p class="text-gray-700 dark:text-gray-400"><strong>{{ __('Comentarios') }}:</strong> {{ $user->comments_count }}</p>
            </div>
        </div>

        <!-- Botón de ver publicaciones -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('user.byPosts', $user) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                {{ __('Ver Publicaciones') }}
            </a>
        </div>
    </div>
</x-blog-layout>

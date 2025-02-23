<x-blog-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200">
        <!-- 📌 Sección de Posts Destacados -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300 mb-4">
                {{ __('Featured Posts') }}
            </h2>

            @forelse($topPosts as $post)
                <div class="mb-4 p-4 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h3>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">{{ __('No featured posts available.') }}</p>
            @endforelse
        </div>

        <hr class="my-6 border-gray-300 dark:border-gray-600">

        <!-- 📌 Sección de Enlaces -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <!-- 🔭 Sección de NASA -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 text-center">
                <h2 class="font-bold text-xl text-gray-800 dark:text-white">{{__('NASA Data')}}</h2>
                <div class="mt-4">
                    <a href="{{ route('nasa.picture') }}" class="block text-blue-500 font-semibold hover:underline">
                        {{__('See Astronomy Picture')}}
                    </a>
                    <a href="{{ route('nasa.asteroids') }}" class="block text-blue-500 font-semibold hover:underline mt-2">
                        {{__('See Asteroids Data')}}
                    </a>
                </div>
            </div>

            <!-- 🌍 Sección de Eventos Naturales -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 text-center">
                <h2 class="font-bold text-xl text-gray-800 dark:text-white">{{__('Natural Events')}}</h2>
                <a href="{{ route('eonet.index') }}" class="block text-blue-500 font-semibold hover:underline mt-4">
                    {{__('See All Events')}}
                </a>
            </div>

            <!-- 📝 Posts del Blog -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 text-center">
                <h2 class="font-bold text-xl text-gray-800 dark:text-white">{{__('Blog')}}</h2>
                <a href="{{ route('posts.index') }}" class="block text-blue-500 font-semibold hover:underline mt-4">
                    {{__('See All Posts')}}
                </a>
            </div>

        </div>
    </div>
</x-blog-layout>

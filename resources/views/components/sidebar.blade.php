<aside class="w-64 bg-gray-900 text-white h-screen p-4 fixed top-0 left-0 overflow-auto">
    <!-- Logo y Nombre -->
    <div class="flex items-center space-x-2 mb-6">
        <a href="/" class="flex items-center">
            <x-application-logo class="block h-10 w-auto"/>
            <span class="text-2xl font-bold tracking-wide" style="font-family: 'Poppins', sans-serif;">AstroBlog</span>
        </a>
    </div>

    <hr class="my-4 border-gray-700">

    <!-- Menú -->
    <h2 class="text-xl font-semibold mb-4">{{ __('Menu') }}</h2>
    <nav>
        <ul class="space-y-3">
            <li>
                <a href="/" class="block hover:text-gray-400 {{ request()->is('/') ? 'text-indigo-400' : '' }}">
                    {{ __('Home') }}
                </a>
            </li>

            @auth
                @hasanyrole('admin|god')
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="block hover:text-gray-400 {{ request()->is('admin/posts*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Posts') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="block hover:text-gray-400 {{ request()->is('admin/categories*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Categories') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tags.index') }}" class="block hover:text-gray-400 {{ request()->is('admin/tags*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Tags') }}
                    </a>
                </li>
                @endhasanyrole

                @role('user')
                <li>
                    <a href="{{ route('user.posts.index') }}" class="block hover:text-gray-400 {{ request()->is('user/posts*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Posts') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.categories.index') }}" class="block hover:text-gray-400 {{ request()->is('user/categories*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Categories') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.tags.index') }}" class="block hover:text-gray-400 {{ request()->is('user/tags*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Tags') }}
                    </a>
                </li>
                @endrole
            @endauth

            @guest
                <li>
                    <a href="{{ route('posts.index') }}" class="block hover:text-gray-400 {{ request()->is('posts*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Posts') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}" class="block hover:text-gray-400 {{ request()->is('categories*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Categories') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('tags.index') }}" class="block hover:text-gray-400 {{ request()->is('tags*') ? 'text-indigo-400' : '' }}">
                        {{ __('See all Tags') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.index') }}" class="block hover:text-gray-400 {{ request()->is('map*') ? 'text-indigo-400' : '' }}">
                        {{ __('View Map') }}
                    </a>
                </li>
            @endguest

            <li>
                <a href="/nasa/picture" class="block hover:text-gray-400 {{ request()->is('nasa/picture') ? 'text-indigo-400' : '' }}">
                    {{ __('NASA Picture of the Day') }}
                </a>
            </li>
            <li>
                <a href="/nasa/asteroids" class="block hover:text-gray-400 {{ request()->is('nasa/asteroids') ? 'text-indigo-400' : '' }}">
                    {{ __('Near Asteroids to Earth') }}
                </a>
            </li>
            <li>
                <a href="/events" class="block hover:text-gray-400 {{ request()->is('events') ? 'text-indigo-400' : '' }}">
                    {{ __('Natural and Astronomical Events') }}
                </a>
            </li>
        </ul>
    </nav>
</aside>

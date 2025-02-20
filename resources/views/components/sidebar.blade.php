<aside class="w-64 bg-gray-900 text-white h-screen p-4 fixed top-0 left-0">
    <div class="flex-shrink-0 mr-4">
        <a href="/">
            <x-application-logo class="block h-10 w-auto"/>
            <span class="text-2xl font-bold tracking-wide" style="font-family: 'Poppins', sans-serif;">AstroBlog</span>
        </a>
    </div>
    <hr class="my-4">
    <h2 class="text-xl font-bold mb-4">{{__('Menu')}}</h2>
    <nav>
        <ul class="space-y-3">
            <li><a href="/" class="block hover:text-gray-400">{{__('Home')}}</a></li>
            @auth
                @role('admin')
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Posts') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.create') }}" class="block hover:text-gray-400">
                            {{ __('Create a Post') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Categories') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tags.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Tags') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.map.index') }}" class="block hover:text-gray-400">
                            {{ __('View Map') }}
                        </a>
                    </li>
                @endrole
                @role('user')
                    <li>
                        <a href="{{ route('user.posts.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Posts') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.posts.create') }}" class="block hover:text-gray-400">
                            {{ __('Create a Post') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.categories.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Categories') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.tags.index') }}" class="block hover:text-gray-400">
                            {{ __('See all Tags') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.map.index') }}" class="block hover:text-gray-400">
                            {{ __('View Map') }}
                        </a>
                    </li>
                @endrole
            @endauth
            @guest
                <li>
                    <a href="{{ route('public.posts.index') }}" class="block hover:text-gray-400">
                        {{ __('See all Posts') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.categories.index') }}" class="block hover:text-gray-400">
                        {{ __('See all Categories') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.tags.index') }}" class="block hover:text-gray-400">
                        {{ __('See all Tags') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.map.index') }}" class="block hover:text-gray-400">
                        {{ __('View Map') }}
                    </a>
                </li>
            @endguest
            <li><a href="/nasa/picture" class="block hover:text-gray-400">{{__('NASA Picture of the Day')}}</a></li>
            <li><a href="/nasa/asteroids" class="block hover:text-gray-400">{{__('Near Asteroids to Earth')}}</a></li>
            <li><a href="/events" class="block hover:text-gray-400">{{__('Natural and Astronomical Events')}}</a></li>
        </ul>
    </nav>
</aside>

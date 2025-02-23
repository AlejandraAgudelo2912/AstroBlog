<div>
    <!-- Botón en el navbar -->
    <button wire:click="openModal"  class="text-white hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium">
       <img src="{{ asset('images/user-settings.png') }}" alt="Admin Panel" class="h-6 w-6 inline-block">
    </button>

    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96 relative">
                <!-- Botón de cerrar -->
                <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 text-xl">
                    &times;
                </button>

                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Admin Panel') }}
                </h2>

                @role('god')
                    <a href="{{route('users.index')}}" :active="request()->routeIs('users.index')"><img src="{{ asset('images/manage-users.png') }}" alt="Admin Panel" class="h-6 w-6 inline-block">
                                {{ __('Manage Users') }}
                    </a>
                @endrole
                @role('admin')
                    <a href="{{route('admin.users.list')}}" >
                        <img src="{{ asset('images/users-list.png') }}" alt="Admin Panel" class="h-6 w-6 inline-block">
                        {{ __('Users List') }}
                    </a>
                <a href="{{route('admin.posts.list')}}" >
                    <img src="{{ asset('images/posts-list.png') }}" alt="Admin Panel" class="h-6 w-6 inline-block">
                    {{ __('Posts List') }}
                </a>
                @endrole
            </div>
        </div>
    @endif
</div>

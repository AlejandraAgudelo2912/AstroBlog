<x-blog-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">{{ __('Editar Usuario') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')

            <label for="name" class="block font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded">

            <label for="email" class="block font-semibold mt-2">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded">

            <label for="roles" class="block font-semibold mt-2">Roles</label>
            <select name="roles[]" multiple class="w-full p-2 border rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded">Guardar</button>
        </form>
    </div>
</x-blog-layout>

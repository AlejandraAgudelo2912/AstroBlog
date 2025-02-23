<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('god.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('god.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('god.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'roles' => 'array',
        ]);

        $user->update($request->only(['name', 'email']));

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('god')) {
            return redirect()->back()->with('error', 'No puedes eliminar un usuario God.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}

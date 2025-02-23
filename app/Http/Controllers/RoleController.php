<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all()->pluck('name');

        return view('god.users.index', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($request->role === 'god' && !auth()->user()->hasRole('god')) {
            return redirect()->back()->with('error', 'No puedes asignar el rol "God".');
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'Rol asignado correctamente.');
    }
}

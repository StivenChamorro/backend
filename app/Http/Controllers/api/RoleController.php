<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Asignar un rol a un usuario
    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        // Asignar el rol al usuario si no lo tiene ya
        if (!$user->roles->contains($role->id)) {
            $user->roles()->attach($role);
        }

        return response()->json(['message' => 'Role assigned successfully']);
    }

    // Eliminar un rol de un usuario
    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        // Quitar el rol del usuario si lo tiene
        if ($user->roles->contains($role->id)) {
            $user->roles()->detach($role);
        }

        return response()->json(['message' => 'Role removed successfully']);
    }

    // Obtener los roles de un usuario
    public function getUserRoles($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->roles);
    }

    // Obtener todos los roles disponibles
    public function getAllRoles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'pic_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen opcional
        'last_name' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'email' => 'required|email|unique:users',
        'user' => 'required|string|max:255',
        'password' => 'required|confirmed|min:8',
    ]);

    try {
        $imageUrl = null; // Inicialmente sin imagen
        if ($request->hasFile('pic_profile')) {
            $image = $request->file('pic_profile');
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();
        }

        $user = User::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'birthdate' => $validated['birthdate'],
            'email' => $validated['email'],
            'user' => $validated['user'],
            'password' => bcrypt($validated['password']),
            'pic_profile' => $imageUrl, // Nulo si no se sube imagen
        ]);

        return response()->json([
            'message' => 'User created successfully!',
            'user' => $user,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error creating the user.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'message' => 'User retrieved successfully!',
                'user' => $user,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id = null)
{
    try {
        // Determinar si es el usuario autenticado o uno específico
        $user = $id ? User::findOrFail($id) : $request->user();

        // Validar los datos enviados
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'pic_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'last_name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'user' => 'nullable|string|max:255',
        ]);

        $imageUrl = $user->pic_profile; // Mantener la imagen actual si no hay nueva

        if ($request->hasFile('pic_profile')) {
            // Si hay imagen nueva, eliminar la anterior de Cloudinary
            if ($user->pic_profile) {
                $publicId = pathinfo(parse_url($user->pic_profile, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            // Subir la nueva imagen
            $image = $request->file('pic_profile');
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();
        }

        // Actualizar los campos enviados
        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'last_name' => $validated['last_name'] ?? $user->last_name,
            'birthdate' => $validated['birthdate'] ?? $user->birthdate,
            'email' => $validated['email'] ?? $user->email,
            'user' => $validated['user'] ?? $user->user,
            'pic_profile' => $imageUrl,
        ]);

        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user->only(['id', 'name', 'last_name', 'birthdate', 'email', 'user', 'pic_profile']),
        ], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation error.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'message' => 'User not found.',
            'error' => $e->getMessage(),
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating the user.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->pic_profile) {
                $publicId = pathinfo(parse_url($user->pic_profile, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully!',
                'user' => $user,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }




public function validateBirthYear(Request $request)
{
    $validated = $request->validate([
        'year' => 'required|integer|digits:4',
    ]);

    try {
        $user = Auth::user(); // Obtener el usuario autenticado
        $birthYear = Carbon::parse($user->birthdate)->year; // Obtener el año de nacimiento del usuario

        if ($birthYear == $validated['year']) {
            return response()->json([
                'message' => 'Fecha de nacimiento correcta',
                'success' => true
            ], 200);
        }

        return response()->json([
            'message' => 'Fecha de nacimiento incorrecta',
            'success' => false
        ], 400);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al validar la fecha de nacimiento',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function getChildren($userId) {
    // Obtén al padre con el id proporcionado
    $father = User::find($userId);

    // Verifica si el padre existe
    if (!$father) {
        return response()->json([
            'message' => 'Padre no encontrado.',
        ], 404);
    }

    // Recupera los niños de ese padre
    $children = $father->children;

    return response()->json([
        'children' => $children,
    ], 200);
}

public function getFirstChild(Request $request)
{
    try {
        // Obtener el usuario autenticado
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Obtener el primer niño asociado a este usuario
        $child = $user->Childrens()->first(); // Obtener el primer niño (puedes ordenar si es necesario)

        if (!$child) {
            return response()->json(['message' => 'No children found for this user'], 404);
        }

        return response()->json([
            'message' => 'First child retrieved successfully!',
            'child' => $child,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error retrieving first child.',
            'error' => $e->getMessage(),
        ], 500);
    }
}



}



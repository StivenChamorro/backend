<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\User;
use App\Models\Level;
use App\Models\LevelCompletion;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function index()
    {
        $childrens = Children::all();
        return response()->json($childrens);
    }

    public function store(Request $request)
    {
        // Validar los campos del formulario (sin 'user_id', ya que se asigna automáticamente)
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date',
            'nickname' => 'required|max:255',
            'relation' => 'required|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'diamonds' => 'required|max:100',
            'gender' => 'required|max:100',
        ]);
    
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized: User not logged in',
                ], 401);
            }
    
            // Subir imagen a Cloudinary si se envió
            $avatarUrl = null;
            if ($request->hasFile('avatar')) {
                $uploadedFile = Cloudinary::upload($request->file('avatar')->getRealPath());
                $avatarUrl = $uploadedFile->getSecurePath();
            }
    
            // Crear el registro del niño
            $children = Children::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'birthdate' => $request->birthdate,
                'nickname' => $request->nickname,
                'relation' => $request->relation,
                'avatar' => $avatarUrl,
                'gender' => $request->gender,
                'diamonds' => $request->diamonds,
                'user_id' => $user->id, // Asociar automáticamente al usuario autenticado
            ]);
    
            return response()->json([
                'message' => 'Children created successfully!',
                'children' => $children,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating children.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $children = Children::with('User')->findOrFail($id);
            return response()->json([
                'message' => 'Child retrieved successfully!',
                'children' => $children,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Child not found.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $children = Children::findOrFail($id);

            $validated = $request->validate([
                'name' => 'nullable|max:255',
                'lastname' => 'nullable|max:255',
                'birthdate' => 'nullable|date',
                'nickname' => 'nullable|max:255',
                'relation' => 'nullable|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gender' => 'nullable|max:100',
                'diamonds' => 'nullable|max:100',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $imageUrl = $children->avatar; // Mantener la imagen actual si no se actualiza

            if ($request->hasFile('avatar')) {
                // Si hay una nueva imagen, eliminar la anterior en Cloudinary
                if ($children->avatar) {
                    $publicId = pathinfo(parse_url($children->avatar, PHP_URL_PATH), PATHINFO_FILENAME);
                    Cloudinary::destroy($publicId);
                }

                // Subir la nueva imagen
                $image = $request->file('avatar');
                $uploadedFile = Cloudinary::upload($image->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
            }

            // Actualizar los datos del niño
            $children->update(array_merge($validated, [
                'avatar' => $imageUrl,
            ]));

            return response()->json([
                'message' => 'Child updated successfully!',
                'children' => $children,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Child not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating child.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $children = Children::findOrFail($id);

            // Si hay una imagen, eliminarla de Cloudinary
            if ($children->avatar) {
                $publicId = pathinfo(parse_url($children->avatar, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $children->delete();

            return response()->json([
                'message' => 'Child deleted successfully!',
                'children' => $children,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Child not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting child.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function completeLevel(Request $request, $childId, $levelId)
{
    try {
        // Obtener el niño y el nivel
        $children = Children::findOrFail($childId);
        $level = Level::findOrFail($levelId);

        // Verificar si el niño ya ha completado este nivel
        $levelCompletion = LevelCompletion::where('child_id', $childId)->where('level_id', $levelId)->first();

        if (!$levelCompletion) {
            // Si no existe el registro de nivel completado, crearlo
            $levelCompletion = LevelCompletion::create([
                'child_id' => $childId,
                'level_id' => $levelId,
                'status' => 'completed', // Marcar como completado
            ]);
        } else {
            // Si ya existe el registro, solo actualizar el estado
            $levelCompletion->update(['status' => 'completed']);
        }

        // Actualizar los diamonds del niño
        $children->diamonds += $level->score;  // Aumentar los diamantes con el score del nivel
        $children->save();

        return response()->json([
            'message' => 'Level completed and diamonds updated successfully!',
            'diamonds' => $children->diamonds,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error completing level or updating diamonds.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

//cambiar de cuenta de niño
public function findByNickname(Request $request)
{
    $request->validate([
        'nickname' => 'required|string',
    ]);

    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $child = $user->Childrens()->where('nickname', $request->nickname)->first();

    if (!$child) {
        return response()->json(['message' => 'Child not found'], 404);
    }

    return response()->json($child, 200);
}


}

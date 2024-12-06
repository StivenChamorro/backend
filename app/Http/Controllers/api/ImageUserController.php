<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Image_User;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'exchange_id' => 'nullable|exists:exchanges,id',
            'url_imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Subir imagen a Cloudinary
            $uploadedFile = Cloudinary::upload($request->file('url_imagen')->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();

            // Crear registro en la base de datos con la URL de Cloudinary
            $image_user = Image_User::create([
                'exchange_id' => $request->exchange_id,
                'url_imagen' => $imageUrl,
            ]);

            return response()->json([
                'message' => 'Image_User created successfully!',
                'image_user' => $image_user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error uploading image.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $image_users = Image_User::all(); // Puedes agregar filtros o includes si es necesario
        return response()->json($image_users);
    }

    public function show($id)
    {
        $image_user = Image_User::findOrFail($id);
        return response()->json($image_user);
    }

    public function update(Request $request, Image_User $imageUser)
    {
        $request->validate([
            'exchange_id' => 'nullable|exists:exchanges,id',
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->only(['exchange_id']);

            // Subir imagen a Cloudinary si se envió una nueva imagen
            if ($request->hasFile('url_imagen')) {
                $uploadedFile = Cloudinary::upload($request->file('url_imagen')->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
                $data['url_imagen'] = $imageUrl;
            }

            // Actualizar registro en la base de datos
            $imageUser->update($data);

            return response()->json([
                'message' => 'Image_User updated successfully!',
                'image_user' => $imageUser,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating image.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Image_User $imageUser)
    {
        $imageUser->delete();
        return response()->json([
            'message' => 'Image_User deleted successfully!',
            'image_user' => $imageUser,
        ]);
    }

    public function getImagesByChild($childId)
    {
        $child = Children::find($childId);
        if (!$child) {
            return response()->json(['error' => 'Child not found.'], 404);
        }
    
        $images = Image_User::where('children_id', $childId)
                            ->with('image') // Asegúrate de que la relación 'image' esté configurada
                            ->get();
    
        return response()->json($images);
    }
    

}

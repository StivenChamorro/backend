<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Cloudinary\Laravel\Facades\Cloudinary; // Asegúrate de usar el alias correcto
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return response()->json($topics);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        $image = $request->file('image');

        // Subir la imagen a Cloudinary
        $uploadedFile = Cloudinary::upload($image->getRealPath());

        // Obtener la URL segura de la imagen subida
        $imageUrl = $uploadedFile->getSecurePath();

        $topic = Topic::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl,
        ]);

        return response()->json(['message' => 'Topic created successfully!', 'topic' => $topic]);
    }

    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return response()->json(['message' => 'Registro mostrado exitosamente', 'topic' => $topic]);
    }

    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // La imagen es opcional
            'description' => 'required|string|max:200',
        ]);

        if ($request->hasFile('image')) {
            if ($topic->image) {
                // Extraer el `public_id` para eliminar la imagen anterior
                $publicId = pathinfo(parse_url($topic->image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $image = $request->file('image');
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();
        } else {
            $imageUrl = $topic->image;
        }

        $topic->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl,
        ]);

        return response()->json(['message' => 'Topic updated successfully!', 'topic' => $topic]);
    }

    public function destroy(Topic $topic)
    {
        if ($topic->image) {
            $publicId = pathinfo(parse_url($topic->image, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy($publicId);
        }

        $topic->delete();
        return response()->json(['message' => 'Registro eliminado exitosamente', 'topic' => $topic]);
    }
}

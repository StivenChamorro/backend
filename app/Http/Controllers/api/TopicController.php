<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /* En el metodo INDEX es por donde vamos a recibir todos los topics/temas que están en nuestra bd. */
    public function index()
    {
        $topics = Topic::all(); // Obtenemos todos los temas
        return response()->json($topics); // Retornamos la lista de temas como respuesta en formato JSON
    }

    /* En el metodo STORE es por donde vamos a ingresar nuestro nuevo topic/tema y guardarlo en la bd. */
    public function store(Request $request)
    {
        // Validamos los datos de entrada, incluyendo la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        // Obtenemos la imagen enviada en la petición
        $image = $request->file('image');

        // Subir la imagen a Cloudinary
        $uploadedFile = Cloudinary()->upload($image->getRealPath());

        // Obtener la URL segura de la imagen subida
        $imageUrl = $uploadedFile->getSecurePath();

        // Guardamos el topic con los datos proporcionados
        $topic = Topic::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl, // Guardamos la URL de la imagen
        ]);

        // Devolvemos una respuesta con el topic creado
        return response()->json(['message' => 'Topic created successfully!', 'topic' => $topic]);
    }

    /* En el metodo SHOW es por donde vamos a mostrar un topic/tema específico alojado en nuestra bd. */
    public function show($id)
    {
        $topic = Topic::findOrFail($id); // Buscar el tema por su ID
        return response()->json(['message' => 'Registro mostrado exitosamente', 'topic' => $topic]);
    }

    /* En el metodo UPDATE es donde actualizamos el topic/tema específico alojado en nuestra bd. */
    public function update(Request $request, Topic $topic)
    {
        // Validamos los datos de entrada
        $request->validate([
            'name' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:200',
        ]);

        // Si se sube una nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen antigua de Cloudinary si existe
            if ($topic->image) {
                // Usamos Cloudinary API para eliminar la imagen anterior si es necesario.
                // Cloudinary::destroy($topic->image);
            }

            // Subir la nueva imagen a Cloudinary
            $image = $request->file('image');
            $uploadedFile = Cloudinary()->upload($image->getRealPath());

            // Obtener la URL segura de la nueva imagen subida
            $imageUrl = $uploadedFile->getSecurePath();
        } else {
            // Si no se sube una nueva imagen, usamos la URL actual
            $imageUrl = $topic->image;
        }

        // Actualizamos el tema con los nuevos datos
        $topic->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl, // Guardamos la URL de la imagen (nueva o existente)
        ]);

        // Devolvemos la respuesta con el tema actualizado
        return response()->json(['message' => 'Topic updated successfully!', 'topic' => $topic]);
    }

    /* Con el metodo DESTROY eliminamos cualquier topic/tema específico alojado en nuestra bd. */
    public function destroy(Topic $topic)
{
    // Eliminar la imagen de Cloudinary si existe
    if ($topic->image) {
        // Suponiendo que la URL de la imagen almacenada en la base de datos es el enlace seguro completo de Cloudinary
        // Se puede obtener el public_id de la URL de la imagen.
        $publicId = basename($topic->image, ".jpg"); // O el tipo de extensión correspondiente
        Cloudinary()->destroy($publicId);
    }

    // Eliminar el topic de la base de datos
    $topic->delete();
    return response()->json(['message' => "Registro Eliminado Exitosamente", 'topic' => $topic]);
}

}

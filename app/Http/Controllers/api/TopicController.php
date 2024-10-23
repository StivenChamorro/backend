<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Topic;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    /* En el metodo INDEX es por donde vamos a recibir todos los topics/temas que estan en nuestra bd. */
    public function index()
    {
        // $topic = Topic::all();
        $topic = Topic::included()->get();
        return response()->json($topic);
    }
    /* En el metodo STORE es por donde vamos a ingresar nuestro nuevo topic/tema y guardarlo en la bd. */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:200',
            'dificult' => 'required|string|max:100',
        ]);

        $topic = Topic::create($request->all());
        return response()->json(['message' => "Registro Creado Exitosamente", $topic]);
    }
    /* En el metodo SHOW es por donde vamos a mostrar un topic/tema especifico alojado en nuestra bd. */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return response()->json(['message' => "Registgro Enseñado Exitosamente", $topic]);
    }
    /* En el metodo UPDATE es donde actualizamos el topic/tema especifico alojado en nuestra bd. */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:200',
            'dificult' => 'required|string|max:100',
        ]);

        $topic->update($request->all());
        return response()->json(['message' => "Registro Actualizado Exitosamente", $topic]);
    }
    /* Con el metodo DESTROY eliminamos cualquier topic/tema especifico alojado en nuestra bd. */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return response()->json(['message' => "Registro Elimiinado Exitosamente", $topic]);
    }
}

<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Level;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    /* En el metodo INDEX es por donde vamos a recibir todos los level/nivel que estan en nuestra bd. */
    public function index()
    {
        $level = Level::included()->get();
        // $level = Level::all();
        return response()->json($level);
    }
    /* En el metodo STORE es por donde vamos a ingresar nuestro nuevo level/nivel y guardarlo en la bd. */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'score' => 'required|integer|max:255',
            'topic_id' => 'required|exists:topics,id',
        ]);
        $level = Level::create($request->all());
        return response()->json($level);
    }
    /* En el metodo SHOW es por donde vamos a mostrar un level/nivel especifico alojado en nuestra bd. */
    public function show($id)
    {
        $level = Level::findOrFail($id);
        return response()->json(['message' => "el registro se mostro exitosamente", $level]);
    }
    /* En el metodo UPDATE es donde actualizamos el level/nivel especifico alojado en nuestra bd. */
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'score' => 'required|integer|max:255',
            'topic_id' => 'required|exists:topics,id',
            'question_id' => 'required|exists:questions,id',
        ]);
        $level->update($request->all());
        return response()->json(['message' => "el registro se actualizo exitosamente", $level]);
    }
    /* Con el metodo DESTROY eliminamos cualquier level/nivel especifico alojado en nuestra bd. */
    public function destroy(Level $level)
    {
        $level->delete();
        return response()->json(['message' => "el registro se elimino exitosamente", $level]);
    }
}

<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Question;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /* En el metodo INDEX es por donde vamos a recibir todos los questions/preguntas que estan en nuestra bd. */
    public function index()
    {
        // $question = Question::with(['Topic', 'levels'])->get(); // Este metodo ( With )nos ayuda a enlazar con las tablas y trea que los campos a los cuales en este caso (topic y levels) esta asociado question.
        // $question = Question::all();
        $question = Question::included()->get();
        return response()->json($question);
    }
    /* En el metodo STORE es por donde vamos a ingresar nuestro nuevo questions/preguntas y guardarlo en la bd. */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:200',
            'answer' => 'required|string|max:200',
            'score' => 'required|integer|max:100',
            'clue' => 'required|string|max:200',
            'correct_answer' => 'required|string|max:100',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $question = Question::create($request->all());
        return response()->json(['message' => "Registro Creado Exitosamente", $question]);
    }
    /* En el metodo SHOW es por donde vamos a mostrar un questions/preguntas especifico alojado en nuestra bd. */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        return response()->json(['message' => "Registgro Enseñado Exitosamente", $question]);
    }
    /* En el metodo UPDATE es donde actualizamos el questions/preguntas especifico alojado en nuestra bd. */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required|string|max:200',
            'answer' => 'required|string|max:200',
            'score' => 'required|integer|max:100',
            'clue' => 'required|string|max:200',
            'correct_answer' => 'required|string|max:100',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $question->update($request->all());
        return response()->json(['message' => "Registro Actualizado Exitosamente", $question]);
    }
    /* Con el metodo DESTROY eliminamos cualquier questions/preguntas especifico alojado en nuestra bd. */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => "Registro Elimiinado Exitosamente", $question]);
    }
}

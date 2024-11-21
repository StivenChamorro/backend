<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // Mostrar todas las respuestas de una pregunta
    public function index()
    {
        // Obtener las respuestas de la pregunta específica
        $answers = Answer::include()->get();

        return response()->json($answers);
    }

    // Crear una nueva respuesta para una pregunta específica
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'answer' => 'required|string',
            'option' => 'required|in:option1,option2,option3,option4',
            'question_id' => 'required|exists:questions,id'
        ]);

        // Crear una nueva respuesta
        $answer = Answer::create([
            'answer' => $validated['answer'],
            'option' =>  $validated['option'],
            'question_id' =>  $validated['question_id'],
        ]);

        return response()->json($answer, 201);
    }

    // Mostrar una respuesta específica
    public function show($id)
    {
        $answer = Answer::findOrFail($id);

        return response()->json($answer);
    }

    // Actualizar una respuesta
    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
            'option' => 'required|in:option1,option2,option3,option4',
        ]);

        $answer = Answer::findOrFail($id);

        $answer->update($request->only(['answer', 'option']));

        return response()->json($answer);
    }

    // Eliminar una respuesta
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return response()->json(['message' => 'Respuesta eliminada correctamente.']);
    }
}

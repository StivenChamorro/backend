<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $question = Question::where('question', '¿Quién fue el primer ser humano en caminar en la Luna?')->first();

        $answers = [
            ['answer' => 'La Luna', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'El Sol', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Las estrellas', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Los planetas', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Venus', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Marte', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Júpiter', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Saturno', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'El Sol', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'La Luna', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Plutón', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Estrella Polar', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Cuadrada', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Triangular', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Esférica', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Cilíndrica', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => '7', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => '8', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => '9', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => '10', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Mercurio', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Júpiter', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Marte', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Norte', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Este', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Oeste', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Sur', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Planetas', 'option' => 'option1', 'question_id' =>$question->id],
            ['answer' => 'Satélites', 'option' => 'option2', 'question_id' =>$question->id],
            ['answer' => 'Lunas', 'option' => 'option3', 'question_id' =>$question->id],
            ['answer' => 'Esferas de gas', 'option' => 'option4', 'question_id' =>$question->id],
        
            ['answer' => 'Venus', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Tierra', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Mercurio', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Marte', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Júpiter', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Marte', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Urano', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => '12', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => '79', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => '45', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => '60', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Vía Láctea', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Andrómeda', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Sombrero', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Triángulo', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Marte', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Júpiter', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Tierra', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Un planeta pequeño', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Un asteroide', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Un cuerpo de hielo', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Una estrella', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Kepler', 'option' => 'option1', 'question_id' =>$question->id],
            ['answer' => 'Hubble', 'option' => 'option2', 'question_id' =>$question->id],
            ['answer' => 'Vostok', 'option' => 'option3', 'question_id' =>$question->id],
            ['answer' => 'Galileo', 'option' => 'option4', 'question_id' =>$question->id],
        
            ['answer' => 'Una estrella en explosión', 'option' => 'option1', 'question_id' =>$question->id],
            ['answer' => 'Un planeta gigante', 'option' => 'option2', 'question_id' =>$question->id],
            ['answer' => 'Una región de gravedad intensa', 'option' => 'option3', 'question_id' =>$question->id],
            ['answer' => 'Un cometa oscuro', 'option' => 'option4', 'question_id' =>$question->id],
        
            ['answer' => 'Marte', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Venus', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Mercurio', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Saturno', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Planetas fuera del Sistema Solar', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Lunas en otros planetas', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Asteroides gigantes', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'Estrellas moribundas', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => '8 segundos', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => '8 minutos', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => '8 horas', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => '8 días', 'option' => 'option4', 'question_id' => $question->id],
        
            ['answer' => 'Neil Armstrong', 'option' => 'option1', 'question_id' => $question->id],
            ['answer' => 'Yuri Gagarin', 'option' => 'option2', 'question_id' => $question->id],
            ['answer' => 'Buzz Aldrin', 'option' => 'option3', 'question_id' => $question->id],
            ['answer' => 'John Glenn', 'option' => 'option4', 'question_id' => $question->id]
        ];

        foreach ($answers as $answer){
            Answer::create($answer);
        }
    }
}

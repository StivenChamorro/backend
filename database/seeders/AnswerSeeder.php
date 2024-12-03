<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $answers = [
            ['answer' => 'La Luna', 'option' => 'option1', 'question_id' => 1],
            ['answer' => 'El Sol', 'option' => 'option2', 'question_id' => 1],
            ['answer' => 'Las estrellas', 'option' => 'option3', 'question_id' => 1],
            ['answer' => 'Los planetas', 'option' => 'option4', 'question_id' => 1],
        
            ['answer' => 'Venus', 'option' => 'option1', 'question_id' => 2],
            ['answer' => 'Marte', 'option' => 'option2', 'question_id' => 2],
            ['answer' => 'Júpiter', 'option' => 'option3', 'question_id' => 2],
            ['answer' => 'Saturno', 'option' => 'option4', 'question_id' => 2],
        
            ['answer' => 'El Sol', 'option' => 'option1', 'question_id' => 3],
            ['answer' => 'La Luna', 'option' => 'option2', 'question_id' => 3],
            ['answer' => 'Plutón', 'option' => 'option3', 'question_id' => 3],
            ['answer' => 'Estrella Polar', 'option' => 'option4', 'question_id' => 3],
        
            ['answer' => 'Cuadrada', 'option' => 'option1', 'question_id' => 4],
            ['answer' => 'Triangular', 'option' => 'option2', 'question_id' => 4],
            ['answer' => 'Esférica', 'option' => 'option3', 'question_id' => 4],
            ['answer' => 'Cilíndrica', 'option' => 'option4', 'question_id' => 4],
        
            ['answer' => '7', 'option' => 'option1', 'question_id' => 5],
            ['answer' => '8', 'option' => 'option2', 'question_id' => 5],
            ['answer' => '9', 'option' => 'option3', 'question_id' => 5],
            ['answer' => '10', 'option' => 'option4', 'question_id' => 5],
        
            ['answer' => 'Mercurio', 'option' => 'option1', 'question_id' => 6],
            ['answer' => 'Júpiter', 'option' => 'option2', 'question_id' => 6],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => 6],
            ['answer' => 'Marte', 'option' => 'option4', 'question_id' => 6],
        
            ['answer' => 'Norte', 'option' => 'option1', 'question_id' => 7],
            ['answer' => 'Este', 'option' => 'option2', 'question_id' => 7],
            ['answer' => 'Oeste', 'option' => 'option3', 'question_id' => 7],
            ['answer' => 'Sur', 'option' => 'option4', 'question_id' => 7],
        
            ['answer' => 'Planetas', 'option' => 'option1', 'question_id' => 8],
            ['answer' => 'Satélites', 'option' => 'option2', 'question_id' => 8],
            ['answer' => 'Lunas', 'option' => 'option3', 'question_id' => 8],
            ['answer' => 'Esferas de gas', 'option' => 'option4', 'question_id' => 8],
        
            ['answer' => 'Venus', 'option' => 'option1', 'question_id' => 9],
            ['answer' => 'Tierra', 'option' => 'option2', 'question_id' => 9],
            ['answer' => 'Mercurio', 'option' => 'option3', 'question_id' => 9],
            ['answer' => 'Marte', 'option' => 'option4', 'question_id' => 9],
        
            ['answer' => 'Júpiter', 'option' => 'option1', 'question_id' => 10],
            ['answer' => 'Marte', 'option' => 'option2', 'question_id' => 10],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => 10],
            ['answer' => 'Urano', 'option' => 'option4', 'question_id' => 10],
        
            ['answer' => '12', 'option' => 'option1', 'question_id' => 11],
            ['answer' => '79', 'option' => 'option2', 'question_id' => 11],
            ['answer' => '45', 'option' => 'option3', 'question_id' => 11],
            ['answer' => '60', 'option' => 'option4', 'question_id' => 11],
        
            ['answer' => 'Vía Láctea', 'option' => 'option1', 'question_id' => 12],
            ['answer' => 'Andrómeda', 'option' => 'option2', 'question_id' => 12],
            ['answer' => 'Sombrero', 'option' => 'option3', 'question_id' => 12],
            ['answer' => 'Triángulo', 'option' => 'option4', 'question_id' => 12],
        
            ['answer' => 'Marte', 'option' => 'option1', 'question_id' => 13],
            ['answer' => 'Júpiter', 'option' => 'option2', 'question_id' => 13],
            ['answer' => 'Saturno', 'option' => 'option3', 'question_id' => 13],
            ['answer' => 'Tierra', 'option' => 'option4', 'question_id' => 13],
        
            ['answer' => 'Un planeta pequeño', 'option' => 'option1', 'question_id' => 14],
            ['answer' => 'Un asteroide', 'option' => 'option2', 'question_id' => 14],
            ['answer' => 'Un cuerpo de hielo', 'option' => 'option3', 'question_id' => 14],
            ['answer' => 'Una estrella', 'option' => 'option4', 'question_id' => 14],
        
            ['answer' => 'Kepler', 'option' => 'option1', 'question_id' => 15],
            ['answer' => 'Hubble', 'option' => 'option2', 'question_id' => 15],
            ['answer' => 'Vostok', 'option' => 'option3', 'question_id' => 15],
            ['answer' => 'Galileo', 'option' => 'option4', 'question_id' => 15],
        
            ['answer' => 'Una estrella en explosión', 'option' => 'option1', 'question_id' => 16],
            ['answer' => 'Un planeta gigante', 'option' => 'option2', 'question_id' => 16],
            ['answer' => 'Una región de gravedad intensa', 'option' => 'option3', 'question_id' => 16],
            ['answer' => 'Un cometa oscuro', 'option' => 'option4', 'question_id' => 16],
        
            ['answer' => 'Marte', 'option' => 'option1', 'question_id' => 17],
            ['answer' => 'Venus', 'option' => 'option2', 'question_id' => 17],
            ['answer' => 'Mercurio', 'option' => 'option3', 'question_id' => 17],
            ['answer' => 'Saturno', 'option' => 'option4', 'question_id' => 17],
        
            ['answer' => 'Planetas fuera del Sistema Solar', 'option' => 'option1', 'question_id' => 18],
            ['answer' => 'Lunas en otros planetas', 'option' => 'option2', 'question_id' => 18],
            ['answer' => 'Asteroides gigantes', 'option' => 'option3', 'question_id' => 18],
            ['answer' => 'Estrellas moribundas', 'option' => 'option4', 'question_id' => 18],
        
            ['answer' => '8 segundos', 'option' => 'option1', 'question_id' => 19],
            ['answer' => '8 minutos', 'option' => 'option2', 'question_id' => 19],
            ['answer' => '8 horas', 'option' => 'option3', 'question_id' => 19],
            ['answer' => '8 días', 'option' => 'option4', 'question_id' => 19],
        
            ['answer' => 'Neil Armstrong', 'option' => 'option1', 'question_id' => 20],
            ['answer' => 'Yuri Gagarin', 'option' => 'option2', 'question_id' => 20],
            ['answer' => 'Buzz Aldrin', 'option' => 'option3', 'question_id' => 20],
            ['answer' => 'John Glenn', 'option' => 'option4', 'question_id' => 20]
        ];

        foreach ($answers as $answer){
            Answer::create($answer);
        }
    }
}

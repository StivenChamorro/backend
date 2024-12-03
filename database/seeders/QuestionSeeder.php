<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $questions = [
            [
                "id" => 1,
                "question" => "¿Qué ilumina el cielo durante el día?",
                "correct_answer" => "El Sol",
                "score" => 50,
                "clue" => "Es una gran estrella.",
                "level_id" => 4
            ],
            [
                "id" => 2,
                "question" => "¿Qué planeta es conocido como el planeta rojo?",
                "correct_answer" => "Marte",
                "score" => 50,
                "clue" => "Es el cuarto planeta del Sistema Solar.",
                "level_id" => 4
            ],
            [
                "id" => 3,
                "question" => "¿Cuál es el satélite natural de la Tierra?",
                "correct_answer" => "La Luna",
                "score" => 55,
                "clue" => "Lo ves por la noche.",
                "level_id" => 4
            ],
            [
                "id" => 4,
                "question" => "¿Qué forma tiene la Tierra?",
                "correct_answer" => "Esférica",
                "score" => 55,
                "clue" => "Es como una pelota.",
                "level_id" => 4
            ],
            [
                "id" => 5,
                "question" => "¿Cuántos planetas tiene el Sistema Solar?",
                "correct_answer" => "8",
                "score" => 60,
                "clue" => "El número cambió cuando Plutón fue reclasificado.",
                "level_id" => 4
            ],
            [
                "id" => 6,
                "question" => "¿Qué planeta tiene anillos alrededor?",
                "correct_answer" => "Saturno",
                "score" => 60,
                "clue" => "Es conocido por sus anillos.",
                "level_id" => 4
            ],
            [
                "id" => 7,
                "question" => "¿En qué dirección sale el Sol?",
                "correct_answer" => "Este",
                "score" => 65,
                "clue" => "Es la dirección contraria al oeste.",
                "level_id" => 4
            ],
            [
                "id" => 8,
                "question" => "¿Qué son las estrellas?",
                "correct_answer" => "Esferas de gas",
                "score" => 65,
                "clue" => "Brillan debido a la fusión nuclear.",
                "level_id" => 4
            ],
            [
                "id" => 9,
                "question" => "¿Cuál es el planeta más cercano al Sol?",
                "correct_answer" => "Mercurio",
                "score" => 70,
                "clue" => "Es muy caliente y está más cerca del Sol.",
                "level_id" => 4
            ],
            [
                "id" => 10,
                "question" => "¿Qué planeta es conocido por sus fuertes tormentas?",
                "correct_answer" => "Júpiter",
                "score" => 70,
                "clue" => "Tiene una gran mancha roja.",
                "level_id" => 4
            ],
            [
                "id" => 11,
                "question" => "¿Cuántas lunas tiene Júpiter?",
                "correct_answer" => "79",
                "score" => 75,
                "clue" => "Es el planeta con más lunas conocidas.",
                "level_id" => 5
            ],
            [
                "id" => 12,
                "question" => "¿Cuál es el nombre de nuestra galaxia?",
                "correct_answer" => "Vía Láctea",
                "score" => 75,
                "clue" => "Es una galaxia espiral donde está el Sistema Solar.",
                "level_id" => 5
            ],
            [
                "id" => 13,
                "question" => "¿Qué planeta tiene la gravedad más fuerte?",
                "correct_answer" => "Júpiter",
                "score" => 80,
                "clue" => "Es el planeta más grande del Sistema Solar.",
                "level_id" => 5
            ],
            [
                "id" => 14,
                "question" => "¿Qué es un cometa?",
                "correct_answer" => "Un cuerpo de hielo",
                "score" => 80,
                "clue" => "Está compuesto de hielo, polvo y rocas.",
                "level_id" => 5
            ],
            [
                "id" => 15,
                "question" => "¿Qué telescopio espacial ha capturado imágenes del espacio profundo?",
                "correct_answer" => "Hubble",
                "score" => 85,
                "clue" => "Fue lanzado por la NASA en 1990.",
                "level_id" => 5
            ],
            [
                "id" => 16,
                "question" => "¿Qué es un agujero negro?",
                "correct_answer" => "Una región de gravedad intensa",
                "score" => 85,
                "clue" => "Ni siquiera la luz puede escapar de él.",
                "level_id" => 5
            ],
            [
                "id" => 17,
                "question" => "¿Qué planeta tiene un día más largo que un año?",
                "correct_answer" => "Venus",
                "score" => 90,
                "clue" => "Gira muy lentamente sobre su eje.",
                "level_id" => 5
            ],
            [
                "id" => 18,
                "question" => "¿Qué son los exoplanetas?",
                "correct_answer" => "Planetas fuera del Sistema Solar",
                "score" => 90,
                "clue" => "Existen más allá de nuestro sistema.",
                "level_id" => 5
            ],
            [
                "id" => 19,
                "question" => "¿Cuántos años tarda la luz del Sol en llegar a la Tierra?",
                "correct_answer" => "8 minutos",
                "score" => 95,
                "clue" => "Es menos de 10 minutos.",
                "level_id" => 5
            ],
            [
                "id" => 20,
                "question" => "¿Quién fue el primer humano en el espacio?",
                "correct_answer" => "Yuri Gagarin",
                "score" => 95,
                "clue" => "Fue un cosmonauta ruso.",
                "level_id" => 5
            ],
            [
                "id" => 21,
                "question" => "¿Qué fenómeno explica la expansión del universo?",
                "correct_answer" => "El Big Bang",
                "score" => 100,
                "clue" => "Es el evento que dio origen al universo.",
                "level_id" => 6
            ],
            [
                "id" => 22,
                "question" => "¿Cómo se llama el punto más cercano al Sol en la órbita de un planeta?",
                "correct_answer" => "Perihelio",
                "score" => 100,
                "clue" => "Es lo opuesto al afelio.",
                "level_id" => 6
            ],
            [
                "id" => 23,
                "question" => "¿Qué es un año luz?",
                "correct_answer" => "La distancia que recorre la luz en un año",
                "score" => 105,
                "clue" => "Es una medida de distancia, no de tiempo.",
                "level_id" => 6
            ],
            [
                "id" => 24,
                "question" => "¿Qué planeta tiene la luna más grande del Sistema Solar?",
                "correct_answer" => "Júpiter",
                "score" => 105,
                "clue" => "La luna se llama Ganímedes.",
                "level_id" => 6
            ],
            [
                "id" => 25,
                "question" => "¿Qué elemento es el principal componente del Sol?",
                "correct_answer" => "Hidrógeno",
                "score" => 110,
                "clue" => "Es el elemento más ligero.",
                "level_id" => 6
            ],
            [
                "id" => 26,
                "question" => "¿Qué provoca las estaciones del año?",
                "correct_answer" => "La inclinación del eje terrestre",
                "score" => 110,
                "clue" => "Es debido a la inclinación de 23.5 grados.",
                "level_id" => 6
            ],
            [
                "id" => 27,
                "question" => "¿Qué es la Vía Láctea?",
                "correct_answer" => "Una galaxia",
                "score" => 115,
                "clue" => "Es el hogar de nuestro Sistema Solar.",
                "level_id" => 6
            ],
            [
                "id" => 28,
                "question" => "¿Qué planeta tiene el día más corto?",
                "correct_answer" => "Júpiter",
                "score" => 115,
                "clue" => "Un día dura menos de 10 horas.",
                "level_id" => 6
            ],
            [
                "id" => 29,
                "question" => "¿Qué instrumento mide los terremotos en la Tierra?",
                "correct_answer" => "Sismógrafo",
                "score" => 120,
                "clue" => "Detecta ondas sísmicas.",
                "level_id" => 6
            ],
            [
                "id" => 30,
                "question" => "¿Qué tipo de galaxia es la Vía Láctea?",
                "correct_answer" => "Espiral",
                "score" => 120,
                "clue" => "Tiene brazos que giran en espiral.",
                "level_id" => 6
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}

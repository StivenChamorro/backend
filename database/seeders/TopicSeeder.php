<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            [
                'name' => 'Astronomía',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733189644/xdkwfucnprg95el6pxpd.jpg',
                'description' => 'La astronomía es el estudio del espacio, las estrellas, los planetas y otros objetos celestes. En este tema, aprenderás sobre los secretos del universo mientras acompañas a Wooper, nuestra mascota, en un viaje hacia el espacio. ¡Prepárate para explorar planetas, estrellas y descubrir los misterios del cosmos!',
            ],
            [
                'name' => 'Arte',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733189737/bfb0irv1hoogf6oczuay.jpg',
                'description' => 'En el tema de arte, exploraremos diferentes formas de expresión artística como la pintura, la escultura y el dibujo. Wooper te acompañará en este viaje creativo para aprender sobre los artistas más famosos y cómo puedes crear tus propias obras de arte. ¡Deja volar tu imaginación!',
            ],
            [
                'name' => 'Español',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733189805/geujfr7gacuyhztcgyu8.jpg',
                'description' => 'Este tema está dedicado a mejorar tus habilidades en español. Aprenderás sobre gramática, vocabulario y comprensión lectora. Con Wooper a tu lado, los ejercicios de conjugación, lectura y escritura serán mucho más divertidos. ¡Vas a disfrutar mientras perfeccionas tu español!',
            ],
            [
                'name' => 'Ciencias Sociales',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733189860/z0w5s8bkjfdh953n5vmg.jpg',
                'description' => 'En ciencias sociales, estudiaremos temas sobre historia, geografía y cultura. Descubre cómo las sociedades se han formado a lo largo del tiempo y aprende sobre las costumbres y tradiciones de diferentes partes del mundo. Wooper te guiará mientras exploras todo sobre el mundo que te rodea.',
            ],
            [
                'name' => 'Matemáticas',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733189917/axxvjh0zpwh3d7f6gmby.jpg',
                'description' => 'Las matemáticas pueden ser muy divertidas, ¡y Wooper lo sabe! En este tema, aprenderás desde las operaciones básicas hasta conceptos más avanzados como fracciones y geometría. Acompáñanos y empieza a resolver problemas y a descubrir cómo las matemáticas están presentes en tu vida diaria.',
            ],
            [
                'name' => 'Biología',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733190127/f3afriwppiryssyu6yte.jpg',
                'description' => 'La biología es el estudio de la vida. En este tema, aprenderás sobre los seres vivos, desde las plantas y animales hasta las células que forman nuestros cuerpos. Junto a Wooper, podrás explorar el mundo natural y entender cómo todo está conectado. ¡Ven y aprende sobre la vida en nuestro planeta!',
            ],
            [
                'name' => 'Inglés',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733190199/mjsz4y02suk7thdyrfq4.jpg',
                'description' => 'El inglés es un idioma global, y en este tema, podrás mejorar tus habilidades en la lengua. Aprende vocabulario, gramática y cómo construir oraciones en inglés. ¡Wooper estará a tu lado para hacer que el aprendizaje del inglés sea fácil y divertido!',
            ],
            [
                'name' => 'Minijuegos',
                'image' => 'https://res.cloudinary.com/drdpddirw/image/upload/v1733190278/oduxmamd1gigbuauajk5.jpgs',
                'description' => 'Los minijuegos son una excelente manera de aprender mientras te diviertes. En este tema, podrás disfrutar de diferentes juegos interactivos relacionados con los temas que has estudiado. ¡Con Wooper, cada juego será una nueva aventura de aprendizaje y diversión!',
            ],
        ];

        // Insertar los temas en la tabla 'topics'
        foreach ($topics as $topic) {
            DB::table('topics')->insert([
                'name' => $topic['name'],
                'image' => $topic['image'],
                'description' => $topic['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChildrenSeeder::class,
            StoreSeeder::class,
            ArticleSeeder::class,
            ExchangeSeeder::class,
            ImageUserSeeder::class,
            QuestionSeeder::class,
            TopicSeeder::class,
            LevelSeeder::class,
            AchievementSeeder::class, 
            AnswerSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\QuestionTypeSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\QuizSeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\ChoiceSeeder;
use Database\Seeders\UserTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            QuestionTypeSeeder::class, 
            CategorySeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            ChoiceSeeder::class,
            UserTypeSeeder::class,
            StudentSeeder::class,
            AdminSeeder::class,
        ]);
    }
}

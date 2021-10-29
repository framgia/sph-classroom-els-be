<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Web development is the work involved in developing a Web site for the Internet or an intranet.',
                'image' => 'webdev.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Science',
                'description' => 'Science is a systematic enterprise that builds and organizes knowledge in the form of testable explanations and predictions about the world.',
                'image' => 'science.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Mathemathics',
                'description' => 'Mathematics includes the study of such topics as quantity, structure, space, and change. It has no generally accepted definition.',
                'image' => 'math.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Philosophy',
                'description' => 'Philosophy is the study of general and fundamental questions, such as those about existence, reason, knowledge, values, mind, and language.',
                'image' => 'philo.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Language',
                'description' => 'A language is a structured system of communication used by humans, based on speech and gesture, sign, or often writing.',
                'image' => 'lang.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Programming',
                'description' => 'Computer programming is the process of designing and building an executable computer program to accomplish a specific computing result or to perform a specific task.',
                'image' => 'prog.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Arts',
                'description' => 'Art is a wide range of human activities that involve creative imagination and an aim to express technical proficiency, beauty, emotional power, or conceptual ideas.',
                'image' => 'arts.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'History',
                'description' => 'History is the study of the past. Events before the invention of writing systems are considered prehistory.',
                'image' => 'history.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Economics',
                'description' => 'Economics is the social science that studies the production, distribution, and consumption of goods and services.',
                'image' => 'economics.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            [
                'category_id' => 1,
                'title' => 'Web Development Basics',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 2,
                'title' => 'Branches of Science',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 3,
                'title' => 'Math Basic',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 4,
                'title' => 'Philosophy Quiz',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 5,
                'title' => 'Language Facts',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 6,
                'title' => 'Introduction to Programming',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 7,
                'title' => 'All About Painting',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 8,
                'title' => 'Philippines History',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 9,
                'title' => 'Business',
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'published_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('quizzes')->insert($quizzes);
    }
}

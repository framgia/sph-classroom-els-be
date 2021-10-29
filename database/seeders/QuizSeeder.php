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
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 2,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 3,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 4,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 5,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 6,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 7,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 8,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'category_id' => 9,
                'instruction' => 'Answer the following questions, depending on what is asked before the time limit.',
                'status' => 'Published',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('quizzes')->insert($quizzes);
    }
}

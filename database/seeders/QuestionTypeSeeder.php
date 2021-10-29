<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            [
                'question_type' => 'Multiple Choice',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_type' => 'Fill in the Blanks',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}

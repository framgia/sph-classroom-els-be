<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'quiz_id' => 1,
                'question_type_id' => 1,
                'question' => "What is HTML?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 1,
                'question_type_id' => 2,
                'question' => "Tim Berners-Lee invented _______.",
                'text_answer' => "World Wide Web",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 2,
                'question_type_id' => 1,
                'question' => "What is the study of living things and their vital processes?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 2,
                'question_type_id' => 2,
                'question' => "_______ was the first to use a refracting telescope to make astronomical discoveries.",
                'text_answer' => "Galileo Galilei",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 3,
                'question_type_id' => 1,
                'question' => "Who is known to be the Father of Mathematics",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 3,
                'question_type_id' => 2,
                'question' => "(17 - 6 / 2) + 4 x 3 = _______",
                'text_answer' => "26",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 4,
                'question_type_id' => 1,
                'question' => "Which philosopher is best known for his statement cogito ergo sum?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 4,
                'question_type_id' => 2,
                'question' => "According to _______, knowledge is a justified true belief.",
                'text_answer' => "Plato",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 5,
                'question_type_id' => 1,
                'question' => "What language has the most speakers, including both native and non-native?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 5,
                'question_type_id' => 2,
                'question' => "The Indonesian language uses the _______ alphabet.",
                'image' => null,
                'text_answer' => "Latin",
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 6,
                'question_type_id' => 1,
                'question' => "What is the oldest programming language that was created in 1957 by John Backus.",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 6,
                'question_type_id' => 2,
                'question' => "The set of instructions for a computer is called a _______.",
                'text_answer' => "Program",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 7,
                'question_type_id' => 1,
                'question' => "Who painted the Mona Lisa?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 7,
                'question_type_id' => 2,
                'question' => "Pablo Picasso is known as the creator of _______.",
                'text_answer' => "Cubism",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 8,
                'question_type_id' => 1,
                'question' => "The Philippines was named after who?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 8,
                'question_type_id' => 2,
                'question' => "_______ is the founder of KKK.",
                'text_answer' => "Emilio Aguinaldo",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 9,
                'question_type_id' => 1,
                'question' => "A person who starts a business to produce a new product in the marketplace is known as?",
                'text_answer' => null,
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'quiz_id' => 9,
                'question_type_id' => 2,
                'question' => "_______ ownership of the factors of production is a defining characteristic of market economies.",
                'text_answer' => "Private",
                'image' => null,
                'time_limit' => 10,
                'created_at' => date("Y-m-d H:i:s")
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}

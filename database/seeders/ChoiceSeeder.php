<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $choices = [
            [
                'question_id' => 1,
                'choice' => 'How to Make Lumpia',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 1,
                'choice' => 'HyperText Markup Language',
                'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 1,
                'choice' => 'HyperText Mixed Language',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 1,
                'choice' => 'High Type Mixed Language',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 2,
                'choice' => 'Genetics',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 2,
                'choice' => 'Zoology',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 2,
                'choice' => 'Botany',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 2,
                'choice' => 'Biology',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 3,
                'choice' => 'Archimedes',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 3,
                'choice' => 'Plato',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 3,
                'choice' => 'Sumerians',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 3,
                'choice' => 'Leonardo Da Vinci',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 4,
                'choice' => 'Saint Thomas Aquinas',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 4,
                'choice' => 'René Descartes',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 4,
                'choice' => 'Aristotle',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 4,
                'choice' => 'Locke',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 5,
                'choice' => 'Hindi',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 5,
                'choice' => 'Mandarin Chinese',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 5,
                'choice' => 'English',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 5,
                'choice' => 'Spanish',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 6,
                'choice' => 'Fortran',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 6,
                'choice' => 'C',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 6,
                'choice' => 'C++',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 6,
                'choice' => 'Java',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 7,
                'choice' => 'Pablo Picasso',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 7,
                'choice' => 'Sandro Bottic',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 7,
                'choice' => 'Leonardo da Vinci',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 7,
                'choice' => 'Raphael',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 8,
                'choice' => 'King Philip',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 8,
                'choice' => 'Lapu-Lapu',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 8,
                'choice' => 'Ferdinand Magellan',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 8,
                'choice' => 'King Philip II',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 9,
                'choice' => 'Owner',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 9,
                'choice' => 'Manager',
		        'is_correct' => true,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 9,
                'choice' => 'Businessman',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'question_id' => 9,
                'choice' => 'Entrepreneur',
                'is_correct' => false,
                'created_at' => date("Y-m-d H:i:s")
            ],
        ];

        DB::table('choices')->insert($choices);
    }
}

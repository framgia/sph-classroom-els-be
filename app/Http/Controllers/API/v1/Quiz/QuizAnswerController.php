<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\StoreQuizAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizAnswerController extends Controller
{
    /**
     * Get all answers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $answers = Answer::with('choice')
                 ->where('quizzes_taken_id', '=', $request->quizzes_taken)
                 ->get();

        return $this->showAll($answers);
    }

    /**
     * Store answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizAnswerRequest $request)
    {
       DB::table('answers')->insert([
            'quizzes_taken_id' => $request->quizzes_taken_id,
            'choice_id' => $request->choice_id,
            'question_id' => $request->question_id,
            'text_answer' => $request->text_answer,
            'text_correct' => $request->text_correct,
            'time_left' => $request->time_left
       ]);

        return $this->successResponse('Successfully Inserted Quiz Answer', 200);
    }
}

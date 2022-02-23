<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\AddEditQuestionRequest;
use App\Models\Choice;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions based on a quiz.
     *
     * @param Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions;

        return $this->showAll($questions, 200);
    }

    public function addQuestion(AddEditQuestionRequest $request, Quiz $quiz)
    {

        $questionType = QuestionType::where()->question_type_id;
        // $choices = Choice::where()->choice;
        $quizId = Quiz::where()->quiz_id;
        $quizAdd = $quiz->$quizId;

        // $addquestion = Question::create([
        //     'quiz_id' => $request->quiz_id,
        //     'question' => $request->question,
        //     'question_type_id' => $request->question_type_id,
        //     'time_limit' => $request->time_limit,
        //     'text_answer' => $request->text_answer,
        // ]);

        $addquestion = Question::create([
            // 'quiz_id' => $request->quiz_id,
            'question' => $request->question,
            // $addQuestion->question_type_id = $request['question_type_id'],
            'time_limit' => $request->time_limit,
            'text_answer' => $request->text_answer,
            // QuestionType::where('question_type_id', $request),
            // Choice::where('choice', $request),
            // Quiz::where('quiz_id', $request),
        ])->where($questionType, $request)
        ->where($quizAdd, $request);

        // $addquestion->save();

        $response = [
            'question' => $addquestion,
        ];

        return $response;
    }
}

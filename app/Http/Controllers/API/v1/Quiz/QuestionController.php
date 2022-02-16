<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Choices\ChoiceRequest;
use App\Http\Requests\Question\AddQuestionRequest;
use App\Http\Requests\Question\EditQuestionRequest;
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

    /**
     * Add questions.
     *
     * @param Quiz $quiz
     * @return \Illuminate\Http\Response
     */

    public function addQuestion(AddQuestionRequest $request)
    {
        $question = Question::create([
            'quiz_id' => $request->quiz_id,
            'question_type_id' => $request->question_type_id,
            'question' => $request->question,
            'time_limit' => $request->time_limit,
            'text_answer' => $request->text_answer,
        ]);

        $response = [
            'question' => $question,
        ];

        return $this->successResponse($response, 200);
    }

      /**
     * Add Choice.
     *
     * @param Quiz $quiz
     * @return \Illuminate\Http\Response
     */

    public function addChoices(ChoiceRequest $request)
    {
        $choice = Choice::create([
            'question_id' => $request->question_id,
            'choice' => $request->choice,
            'is_correct' => $request->is_correct,
        ]);

        $response = [
            'choices' => $choice,
        ];

        return $this->successResponse($response, 200);
    }

      /**
     * Edit questions.
     *
     * @param Quiz $quiz
     * @return \Illuminate\Http\Response
     */

    public function editQuestion(EditQuestionRequest $request)
    {

        $editQuestion = Question::find($request->question_id);

        $editQuestion->quiz_id = $request['quiz_id'];
        $editQuestion->question_type_id = $request['question_type_id'];
        $editQuestion->question = $request['question'];
        $editQuestion->time_limit = $request['time_limit'];
        $editQuestion->text_answer = $request['text_answer'];

        $editQuestion->save();

        $response = [
            'question' => $editQuestion,
        ];

        return $this->successResponse($response, 200);
    }
}

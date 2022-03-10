<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Choices\ChoiceRequest;
use App\Http\Requests\Choices\EditChoiceRequest;
use App\Http\Requests\Question\AddQuestionRequest;
use App\Http\Requests\Question\EditQuestionRequest;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

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
     * @param AddQuestionRequest $request
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
     * @param ChoiceRequest $request
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
     * @param EditQuestionRequest $request
     * @return \Illuminate\Http\Response
     */

    public function editQuestion(Request $request)
    {
        $questions = $request->questions;
        $quiz_id = (int)$request->quizId;
        foreach ($questions as $question) {
            $findQuestion = Question::where('quiz_id', $quiz_id)
                                    ->where('id', $question['id'])
                                    ->exists();
            if ($findQuestion) {
                // Question currently exists in the quiz
                $newQuestion = Question::find($question['id']);
                $newQuestion->question_type_id = $question['question_type_id'];
                $newQuestion->question = $question['question'];
                $newQuestion->time_limit = $question['time_limit'];
                if ($question['question_type_id'] == 2) {
                    $newQuestion->text_answer = $question['text_answer'];
                }
                $newQuestion->save();
            } else {
                // Question does not exist in the quiz
            }
        }

        return $this->successResponse('$response', 200);
    }

      /**
     * Edit choices.
     *
     * @param EditChoiceRequest $request
     * @return \Illuminate\Http\Response
     */

    public function editChoices(EditChoiceRequest $request)
    {

        $editChoices = Choice::find($request->choice_id);

        $editChoices->question_id = $request['question_id'];
        $editChoices->choice = $request['choice'];
        $editChoices->is_correct = $request['is_correct'];

        $editChoices->save();

        $response = [
            'Choice' => $editChoices,
        ];

        return $this->successResponse($response, 200);
    }
}

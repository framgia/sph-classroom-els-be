<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Choices\ChoiceRequest;
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
     * Upsert Choice.
     *
     * @param ChoiceRequest $request
     * @return \Illuminate\Http\Response
     */

    public function upsertChoices($choices, $question_id)
    {
        $plucked_ids = [];
        foreach ($choices as $choice) {
            $findChoice = Choice::where('id', $choice['id'])
                                ->where('question_id', $question_id)
                                ->exists();
            if ($findChoice) {
                // Choice exists in the database
                $existingChoice = Choice::find($choice['id']);
                array_push($plucked_ids, $existingChoice->id);
                $existingChoice->choice = $choice['choice'];
                $existingChoice->is_correct = $choice['is_correct'];
                $existingChoice->save();
            } else {
                // Choice does not exist in the database
                $newChoice = Choice::create([
                    'question_id' => $question_id,
                    'choice' => $choice['choice'],
                    'is_correct' => $choice['is_correct'],
                ]);
                array_push($plucked_ids, $newChoice->id);
            }
        }
        // Deletes the choices that are have been removed
        $deleteChoice = Choice::whereNotIn('id', $plucked_ids)
                                ->where('question_id', $question_id)
                                ->delete();
    }

    public function deleteQuestions($new_question_ids, $quiz_id)
    {
        $deleteQuestions = Question::whereNotIn('id', $new_question_ids)
                                    ->where('quiz_id', $quiz_id)
                                    ->delete();
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
        $plucked_new_question_ids = [];

        foreach ($questions as $question) {
            $findQuestion = Question::where('quiz_id', $quiz_id)
                                    ->where('id', $question['id'])
                                    ->exists();
            if ($findQuestion) {
                // Question currently exists in the quiz
                // Update question here because it exists in the quiz
                $existingQuestion = Question::find($question['id']);

                array_push($plucked_new_question_ids, $existingQuestion->id);

                $existingQuestion->question_type_id = $question['question_type_id'];
                $existingQuestion->question = $question['question'];
                $existingQuestion->time_limit = $question['time_limit'];
                if ($question['question_type_id'] == 1) {
                    // Update or create choices
                    $this->upsertChoices($question['choices'], $question['id']);
                } else {
                    // Update text answer
                    $existingQuestion->text_answer = $question['text_answer'];
                }
                $existingQuestion->save();
            } else {
                // Question does not exist in the quiz
                // Create question here becase it does not exist in the quiz
                if ($question['question_type_id'] == 1) {
                    // Multiple Choice
                    $newQuestion = Question::create([
                        'question' => $question['question'],
                        'question_type_id' => $question['question_type_id'],
                        'time_limit' => $question['time_limit'],
                        'quiz_id' => $quiz_id
                    ]);

                    array_push($plucked_new_question_ids, $newQuestion->id);

                    $this->upsertChoices($question['choices'], $newQuestion->id);
                } else {
                    // Identification type
                    $newQuestion = Question::create([
                        'question' => $question['question'],
                        'question_type_id' => $question['question_type_id'],
                        'time_limit' => $question['time_limit'],
                        'text_answer' => $question['text_answer'],
                        'quiz_id' => $quiz_id
                    ]);

                    array_push($plucked_new_question_ids, $newQuestion->id);
                }
                
            }
        }

        $this->deleteQuestions($plucked_new_question_ids, $quiz_id);
        $this->changeCategory($quiz_id, $request->categoryId);

        $questions = Question::where('quiz_id', $quiz_id)->get();

        return $this->successResponse($questions, 200);
    }

    public function changeCategory($quiz_id, $category_id)
    {
        $quiz = Quiz::find($quiz_id);

        $quiz->category_id = $category_id;
        $quiz->save();
    }
}

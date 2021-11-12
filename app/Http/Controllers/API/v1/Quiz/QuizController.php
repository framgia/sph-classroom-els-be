<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of all quizzes based on a.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $quizzes = $category->quizzes;

        return $this->paginatedList($quizzes);
    }

    /**
     * Display the specified quiz.
     *
     * @param  Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quiz = Quiz::find($request->quiz);

        return $this->showOne($quiz);
    }
}

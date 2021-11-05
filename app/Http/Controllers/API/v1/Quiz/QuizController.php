<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

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

        return $this->showAll($quizzes);
    }
}
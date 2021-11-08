<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

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
}

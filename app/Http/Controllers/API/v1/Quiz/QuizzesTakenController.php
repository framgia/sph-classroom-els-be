<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\StoreQuizTakenRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Quiz\UpdateQuizTakenRequest;

class QuizzesTakenController extends Controller
{
    /**
     * Display a list of quizzes taken by logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Auth::user()->quizzes;

        return $this->showAll($quizzes);
    }

    /**
     * Store a newly quiz taken in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizTakenRequest $request)
    {
        $quizzes_taken_id = DB::table('quizzes_taken')->insertGetId([
            'user_id' => $request->user_id,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return $this->successResponse(['quizzes_taken_id' => $quizzes_taken_id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Auth::user()->quizzes[$id - 1];

        return $this->showOne($quiz);
    }

    /**
     * Update the score of the specified quiz taken in storage after taking a quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizTakenRequest $request)
    {
        DB::table('quizzes_taken')
            ->where('id', $request->quizzes_taken)
            ->update(['score' => $request->score]);   
        
        return $this->successResponse(['score' => $request->score], 201);
    }
}

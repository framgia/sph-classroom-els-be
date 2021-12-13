<?php

namespace App\Http\Controllers\API\v1\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizTaken;
use Illuminate\Http\Request;

class UserRecentQuizzesController extends Controller
{
    public function UserRecentquizzes(Request $request)
    {
        $id = Auth::user()->id;

        $recent = Quiz::join('quizzes_taken', 'quizzes.id', '=',  'quizzes_taken.quiz_id', )
            ->where('quizzes_taken.user_id', '=', $id)
            ->orderByDesc('quizzes_taken.created_at')
            ->limit(4)
            ->get();

        $recentQuizzesId = $recent->unique('quiz_id')->pluck('quiz_id')->all();

        $attempts = QuizTaken::whereIn('quiz_id', $recentQuizzesId)
                               ->orderBy('quiz_id', 'asc')
                               ->get();

        $response = [
            'recentQuizzesTaken' => $recent,
            'attempts' => $attempts
        ];

        return $this->successResponse($response, 200);
    }
}

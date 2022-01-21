<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class UserScoresAndAttemptsController extends Controller
{
    public function UserScoreAndAttempts(Request $request)
    {
        $id = Auth::user()->id;

        $recent = Quiz::join('quizzes_taken', 'quizzes.id', '=',  'quizzes_taken.quiz_id',)
            ->where('quizzes_taken.user_id', $id)
            ->where('quizzes_taken.quiz_id', $request->quiz_id)
            ->orderByDesc('quizzes_taken.created_at')
            ->get();

        return $this->successResponse(["recentQuizzesTaken" => $recent], 200);
    }
    
}

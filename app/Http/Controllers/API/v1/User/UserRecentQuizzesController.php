<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

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
        return $this->showAll($recent);
    }
}

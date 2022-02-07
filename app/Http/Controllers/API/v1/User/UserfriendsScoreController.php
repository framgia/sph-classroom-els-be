<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Models\QuizTaken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\StudentAvatar;

class UserfriendsScoreController extends Controller
{
    use StudentAvatar;

    public function friendsScore(Request $request)
    {
        $followedUsers = DB::table('user_follower')
            ->where('follower_id', Auth::user()->id)
            ->get()
            ->pluck('following_id')
            ->all();

        $followedUsersActivities =  QuizTaken::join('users', 'quizzes_taken.user_id', '=', 'users.id')
            ->whereIn('quizzes_taken.user_id', $followedUsers)
            ->where('quizzes_taken.quiz_id', $request->quiz_id)
            ->orderByDesc('quizzes_taken.created_at')
            ->limit(6)
            ->get();

        $uniqueUser = $followedUsersActivities->unique('user_id')->values();

        return $this->showAll($this->attachAvatarURL($uniqueUser));
    }
}
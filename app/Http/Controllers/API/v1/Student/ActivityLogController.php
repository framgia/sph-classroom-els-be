<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;


class ActivityLogController extends Controller
{

    public function logsActivity(Request $request)
    {
        // $student = User::withCount(['followings', 'followers'])
        // ->where('user_type_id', 2)
        // ->findOrFail($request->id);
        // $student = activity()->log('userlogs');
        // activity()->log('test');
        // return Activity::all();

        $id = Auth::user()->id;

        $recent = Quiz::join('quizzes_taken', 'quizzes.id', '=',  'quizzes_taken.quiz_id', )
            ->where('quizzes_taken.user_id', '=', $id)
            ->orderByDesc('quizzes_taken.created_at')
            ->limit(4)
            ->get();
        return $this->showAll($recent);

        // $student = User::withCount(['followings', 'followers'])
        // ->where('user_type_id', 2)
        // ->findOrFail($request->id);

        // return $this->showAll($student);
    }
}

<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class StudentActivitiesController extends Controller
{
    public function studentActivities(Request $request)
    {

       $activities = Activity::where('causer_id', $request->id)
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();

       return $this->successResponse(['data' => $activities], 200);

    }

    public function followedActivities(Request $request)
    {
        $followedUsers = DB::table('user_follower')
                            ->where('follower_id', Auth::user()->id)
                            ->get()
                            ->pluck('following_id')
                            ->all();

       $followedUsersActivities =  Activity::whereIn('causer_id', $followedUsers)
                                            ->orderByDesc('created_at')
                                            ->limit(10)
                                            ->get();

        return $this->showAll($followedUsersActivities);
    }
}

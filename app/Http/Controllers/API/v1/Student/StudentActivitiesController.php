<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;


class StudentActivitiesController extends Controller
{
    public function studentActivities(Request $request)
    {


        $student = User::withCount(['followings', 'followers'])
        ->where('user_type_id', 2)
        ->findOrFail($request->id);

       $activities = Activity::all()
       ->where('causer_id', $student->id);

       return $this->successResponse(['data' => $activities], 200);

    }
}

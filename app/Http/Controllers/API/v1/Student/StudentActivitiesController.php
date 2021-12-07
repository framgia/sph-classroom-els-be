<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;


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
}

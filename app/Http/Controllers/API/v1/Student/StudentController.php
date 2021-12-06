<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Pagination;
use App\Traits\StudentFilter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use Pagination, StudentFilter;

    public function index()
    {
        $id = Auth::user()->id;

        $query = request()->query();

        if(isset($query['filter'])){
            $filtered_student_list = $this->filter($query, $id);

            return $this->paginate(Auth::user()->attachFollowStatus($filtered_student_list->get()));
        }
     
        $students = User::searchAndExcludeLoggedInUserAndAdmins($id, $query['search'])->get();

        return $this->paginate(Auth::user()->attachFollowStatus($students));
    }

     /**
     * Display the specified student.
     *
     * @param  Students $students
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $student = User::withCount(['followings', 'followers'])
        ->where('user_type_id', 2)
        ->findOrFail($request->id);

        $number_of_quizzes_taken = DB::table('quizzes_taken')->where('user_id', $request->id)->count();

        $response = [
            'details' => Auth::user()->attachFollowStatus($student),
            'quizzesTaken' => $number_of_quizzes_taken
        ];

        return $this->successResponse($response, 200);
    }
}
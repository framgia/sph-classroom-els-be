<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Pagination;
use App\Traits\StudentFilter;
use Illuminate\Http\Request;
use App\Models\User;
class StudentController extends Controller
{
    use Pagination, StudentFilter;

    public function index()
    {
        $id = Auth::user()->id;

        $query = request()->query();

        if(isset($query['filter'])){
            $filtered_student_list = $this->filter($query, $id);

            return $this->paginate($filtered_student_list);
        } else if (isset($query['search'])) {
            $searched_student_list = User::where('name', 'LIKE', '%' . $query['search'] . '%')->get();

            return $this->paginate(Auth::user()->attachFollowStatus($searched_student_list));
        }

        $students = User::withCount(['followings', 'followers'])
            ->where('user_type_id', 2)
            ->where('id', '!=', $id)
            ->get();

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

        return $this->successResponse(['data' => $student], 200);
    }
}
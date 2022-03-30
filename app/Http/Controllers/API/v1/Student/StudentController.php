<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\Pagination;
use App\Traits\StudentFilter;
use App\Traits\StudentAvatar;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Models\User;


class StudentController extends Controller
{
    use Pagination, StudentFilter, StudentAvatar;

    public function index()
    {
        $id = Auth::user()->id;

        $query = request()->query();

        if(isset($query['filter'])){
            $filtered_student_list = $this->filter($query, $id);

            return $this->paginate(Auth::user()->attachFollowStatus($filtered_student_list->get()));
        }
     
        $students = User::searchAndExcludeLoggedInUserAndAdmins($id, $query['search'])->get();

        return $this->paginate($this->attachAvatarURL(Auth::user()->attachFollowStatus($students)));
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

        $url = Storage::url( 'avatar/' . $student->avatar);
        $response = [
            'details' => Auth::user()->attachFollowStatus($student),
            'quizzesTaken' => $number_of_quizzes_taken,
            'avatar' => 'http://localhost:82' . $url
        ];

        return $this->successResponse($response, 200);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $student = Auth::user();

        if(!Hash::check($request->password, $student->password)){
            return $this->errorResponse(['password' =>  trans('auth.password')], 401); 
        }

        $student->password = bcrypt($request->new_password);
        $student->save();

        return $this->successResponse(['message' => 'Your password has been successfully updated.'], 200);
    }
}

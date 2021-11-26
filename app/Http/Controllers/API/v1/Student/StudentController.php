<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Pagination;
use App\Traits\StudentFilter;
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
        }

        $students = User::withCount(['followings', 'followers'])
            ->where('user_type_id', 2)
            ->where('id', '!=', $id)
            ->get();

        return $this->paginate($students);
    }
}
<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use App\Traits\Pagination;
use App\Models\User;

class StudentController extends Controller
{
    use Pagination;


    public function index()
    {
        $id = Auth::user()->id;

        $students = User::withCount(['followings', 'followers'])
            ->where('user_type_id', 2)
            ->where('id', '!=', $id)
        
            ->get();

        return $this->paginate($students);
    }
}

<?php

namespace App\Http\Controllers\API\v1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\Pagination;

class StudentController extends Controller
{
    use Pagination;


    public function index()
    {
        $id = Auth::user()->id;

        $students = DB::table('users')
            ->where('user_type_id', 2)
            ->where('id', '!=', $id)
            ->get(['id', 'name']);

        return $this->paginate($students);
    }
}

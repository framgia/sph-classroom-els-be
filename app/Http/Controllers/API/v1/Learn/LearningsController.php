<?php

namespace App\Http\Controllers\API\v1\Learn;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizTaken;
use App\Traits\Pagination;

class LearningsController extends Controller
{
    use Pagination;
    //
    public function show(Request $request)
    {
        $id = Auth::user()->id;
        
        $quizzes_taken_by_user = Quiz::join('quizzes_taken','quizzes.id', '=', 'quizzes_taken.quiz_id')
                                ->join('categories', 'quizzes.category_id', '=', 'categories.id')
                                ->where('quizzes_taken.user_id', $id)
                                ->orderByDesc('quizzes_taken.created_at')
                                ->limit(12)
                                ->get()
                                ->unique('quiz_id')
                                ->values();


        return $this->paginate($quizzes_taken_by_user);
    }
}

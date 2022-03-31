<?php

namespace App\Http\Controllers\API\v1\Learn;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizTaken;
use App\Traits\Pagination;
use App\Traits\LearningsSort;

class LearningsController extends Controller
{
    use Pagination, LearningsSort;

    public function show(Request $request)
    {
        $id = Auth::user()->id;
        $query = request()->query();
        
        $quizzes_learned = Quiz::join('quizzes_taken','quizzes.id', '=', 'quizzes_taken.quiz_id')
                                ->join('categories', 'quizzes.category_id', '=', 'categories.id')
                                ->where('quizzes_taken.user_id', $id)
                                ->with('questions');
                            
        if(isset($query['sortDirection'])){
            $this->sort($query, $quizzes_learned);
        } 
           
        return $this->paginate($quizzes_learned->get()->unique('quiz_id')->values());
    }
}

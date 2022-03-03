<?php

namespace App\Http\Controllers\API\v1\Quiz;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Pagination;
use App\Models\Quiz;
use App\Models\QuizTaken;
use Illuminate\Http\Request;
use App\Traits\QuizSort;

class QuizController extends Controller
{
    use Pagination, QuizSort;
    
    /**
     * Display a listing of all quizzes based on a.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $quizzes = $category->quizzes;
        
        return $this->paginate($quizzes);
    }

    /**
     * Display the specified quiz.
     *
     * @param  Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quiz = Quiz::find($request->quiz);

        return $this->showOne($quiz);
    }

    public function relatedQuizzes(Request $request)
    {    
        $relatedQuizzes = Category::join('quizzes', 'categories.id', '=', 'quizzes.category_id')
            ->where('categories.id', $request->category_id)
            ->where('quizzes.id', '!=', $request->quiz_id )
            ->limit(4)
            ->get();
        
        $relatedQuizzesId = $relatedQuizzes->pluck('quiz_id')->all();

        $attempts = QuizTaken::whereIn('quiz_id', $relatedQuizzesId)
            ->where('user_id', Auth::user()->id)
            ->orderBy('quiz_id', 'asc')
            ->get();

        $response = [
            'relatedQuizzes' => $relatedQuizzes,
            'attempts' => $attempts
        ];
        
        return $this->successResponse($response, 200);
    }

    public function adminQuiz(Request $request)
    {
        $query = request()->query();

        $quizzes = Category::join('quizzes', 'categories.id', '=', 'quizzes.category_id');

        if(isset($query['sortDirection'])){
            return $this->sort($query, $quizzes);
        }

        return $this->paginate($quizzes->get());
    }

    public function addQuiz(StoreQuizRequest $request)
    {
        $quiz = Quiz::create([
            'instruction' => $request->instruction,
            'category_id' => $request->category_id,
            'title' => $request->title,
        ]);

        $response = [
            'quiz' => $quiz
        ];

        return $this->successResponse($response, 200);
    }
}

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

class QuizController extends Controller
{
    use Pagination;
    
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
        $id = Auth::user()->id;
        
        $admin_quizzes = Category::join('quizzes', 'categories.id', '=', 'quizzes.category_id')
                                ->get();

        return $this->paginate($admin_quizzes);
    }

    public function adminAdd(Request $request)
    {
        $quiz = new Quiz;
        $quiz->title = 'test title';
        $quiz->instruction = 'test instruction';
        $quiz->save();

        // $quiz = Quiz::create([
        //     'instruction' => 'test instruction',
        //     'title' => 'test title',
        // ]);

        return $this->successResponse('test', 200);
    }
}

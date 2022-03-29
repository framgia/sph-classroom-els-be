<?php

namespace App\Http\Controllers\API\v1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\StoreQuizTakenRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Quiz\UpdateQuizTakenRequest;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Category;
use App\Models\QuizTaken;
use App\Models\User;

class QuizzesTakenController extends Controller
{
    /**
     * Display a list of quizzes taken by logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Auth::user()->quizzes;

        return $this->showAll($quizzes);
    }

    /**
     * Store a newly quiz taken in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizTakenRequest $request)
    {

        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $user_type_id = Auth::user()->user_type_id;

        $logged_in_user = User::find($id);

        $quizzes_taken_id = DB::table('quizzes_taken')->insertGetId([
            'user_id' => $request->user_id,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        $quiztaken = QuizTaken::find($quizzes_taken_id);
        
        $quiz = Quiz::find($quiztaken->quiz_id);

        $activityquiz = activity()
        ->causedBy($logged_in_user)
        ->performedOn($quiz)
        ->withProperties([
            'name' => $name, 
            'taken_quiz' => $quiztaken,
            'quiz' => $quiz, 
            'questions' => $quiz->questions,
            'category_id' => $quiz->category_id
        ])->log(':properties.name answered :subject.title');

        return $this->successResponse(['quizzes_taken_id' => $quizzes_taken_id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Auth::user()->quizzes[$id - 1];

        return $this->showOne($quiz);
    }

    /**
     * Update the score of the specified quiz taken in storage after taking a quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizTakenRequest $request)
    {
        DB::table('quizzes_taken')
            ->where('id', $request->quizzes_taken)
            ->update(['score' => $request->score]);   
        
        return $this->successResponse(['score' => $request->score], 201);
    }

    /**
     * Display a list of quizzes taken from other user.
     *
     * @return \Illuminate\Http\Response
     */
    public function recent(Request $request)
    {
        $recent = Quiz::join('quizzes_taken', 'quizzes.id', '=',  'quizzes_taken.quiz_id')
                        ->where('quizzes_taken.user_id', '=', $request->id)
                        ->orderByDesc('quizzes_taken.created_at')
                        ->limit(10)
                        ->get();

        return $this->showAll($recent);
    }

    public function learned(Request $request)
    {
       
        $quizzes_taken_by_user = DB::table('quizzes_taken')
                                ->where('user_id', $request->id)
                                ->get()
                                ->pluck('quiz_id')
                                ->all();
        
        $categories_learned = Category::with(['quizzes' => function ($query) use ($quizzes_taken_by_user) 
                                        {$query->whereIn('id', $quizzes_taken_by_user);
                                    }])
                                    ->has('quizzes')
                                    ->withCount('quizzes')
                                    ->limit(10)
                                    ->get();

        $categories_with_quizzestaken_only = $categories_learned->filter(function ($category_learned) {
            if($category_learned->quizzes->count() > 0 ){
                return $category_learned;
            }
        })->values(); 


        return $this->showAll($categories_with_quizzestaken_only); 
    }
}

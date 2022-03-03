<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

trait QuizSort
{
    protected function sort($query, $quizzes)
    {
        switch($query['sortBy']){
            case 'Name': 
                $sortBy = 'title';
                break;
            case 'Category':
                $sortBy = 'name';
                break;
            default:
                $sortBy = 'quizzes.'.strtolower($query['sortBy']);
        }
        
        return $quizzes->orderBy($sortBy, $query['sortDirection'])->paginate(12);
    }
}

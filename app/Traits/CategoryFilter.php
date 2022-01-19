<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\User;

trait CategoryFilter
{
    protected function filter($query)
    {
        $taken_quizzes_id = Quiz::join('quizzes_taken', 'quizzes.id', '=', 'quizzes_taken.quiz_id')
                            ->where('quizzes_taken.user_id', Auth::user()->id)
                            ->get()
                            ->pluck('category_id')
                            ->all();

        if ($query['filter'] === "Taken"){
            $categories = Category::wherein('id', $taken_quizzes_id);
        } elseif ($query['filter'] === "Not Taken"){
            $categories = Category::whereNotIn('id', $taken_quizzes_id);
        }

        $categories = $categories->whereNull('category_id')
                                 ->where('name', 'LIKE', '%' . $query['search'] . '%')
                                 ->orderBy('name', $query['sortBy'])
                                 ->get();

        return $categories;
    }
}

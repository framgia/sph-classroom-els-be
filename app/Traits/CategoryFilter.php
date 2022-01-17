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
        if ($query['filter'] === "taken"){
            $taken_category = Quiz::join('quizzes_taken', 'quizzes.id', '=', 'quizzes_taken.quiz_id')
                                    ->where('quizzes_taken.user_id', Auth::user()->id)
                                    ->get()
                                    ->pluck('category_id')
                                    ->all();

            $taken_categories = Category::wherein('id', $taken_category)->get();

            return $taken_categories;
        } elseif ($query['filter'] === "not taken"){
            $not_taken_category = Quiz::join('quizzes_taken', 'quizzes.id', '=', 'quizzes_taken.quiz_id')
                                        ->where('quizzes_taken.user_id', Auth::user()->id)
                                        ->get()
                                        ->pluck('category_id')
                                        ->all();

            $not_taken_categories = Category::whereNotIn('id', $not_taken_category)->get();

            return $not_taken_categories;
        }
    }

}
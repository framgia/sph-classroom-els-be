<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Traits\Pagination;

trait LearningsSort
{
    protected function sort($query, $learnings)
    {
        switch($query['sortBy']){
            case 'Quizzes Learned': 
                $sortBy = 'quizzes.title';
                break;
            case 'Categories':
                $sortBy = 'categories.name';
                break;
        }
        
        $learnings->orderBy($sortBy, $query['sortDirection']);

        return $this->paginate($learnings->get()->unique('quiz_id')->values());
    }
}

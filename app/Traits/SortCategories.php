<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;

trait SortCategories
{
    protected function sort($query, $categories)
    {
        switch($query['sortBy']){
            case 'Name': 
                $sortBy = strtolower($query['sortBy']);
                break;
            default:
                $sortBy = 'categories.'.strtolower($query['sortBy']);
        }
        
        return $categories->orderBy($sortBy, $query['sortDirection'])->paginate(12);
    }
}

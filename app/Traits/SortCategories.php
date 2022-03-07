<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;

trait SortCategories
{
    protected function sort($query, $categories)
    {
        return $categories->orderBy(strtolower($query['sortBy']), $query['sortDirection'])->paginate(12);
    }
}

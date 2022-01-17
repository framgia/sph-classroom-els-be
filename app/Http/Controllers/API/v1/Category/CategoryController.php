<?php

namespace App\Http\Controllers\API\v1\Category;

use App\Traits\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\Pagination;

class CategoryController extends Controller
{

    use Pagination, CategoryFilter;

    /**
     * Display a listing of Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = request()->query();
        
        $categories = Category::withCount('subcategories');

        if(isset($query['filter'])){
            $filtered_categories = $this->filter($query);

            return $this->paginate($filtered_categories);
        }

        if (request()->has('category_id')){
            $categories = $categories->where('category_id', request('category_id'));
        }else{
            $categories = $categories->whereNull('category_id')
                                     ->orderBy('name', $query['sortBy']);
        }

        return $this->paginate($categories->get());
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
       $newCategory = Category::create($request->all());

        return $this->showOne($newCategory, 201);
    }

    /**
     * Display the specified category.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::withCount(['subcategories', 'quizzes'])->findOrFail($id);
        return $this->showOne($category);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->only(['name', 'description', 'image', 'category_id']));

        if($category->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $category->update($request->all());

        return $this->showOne($category, 201);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category  $category)
    {
        $category->delete();

        return $this->showOne($category);
    }
}

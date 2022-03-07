<?php

namespace App\Http\Controllers\API\v1\Category;

use App\Traits\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\Pagination;
use App\Traits\SortCategories;

class CategoryController extends Controller
{

    use Pagination, CategoryFilter, SortCategories;

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
                                     ->where('name', 'LIKE', '%' . $query['search'] . '%')
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

    public function getCategories()
    {
        $query = request()->query();
        
        $categories = Category::withCount('subcategories');

        if (request()->has('category_id')){
            $categories = $categories->where('category_id', request('category_id'));
        }else{
            $categories = $categories->whereNull('category_id');
        }

        return $this->showAll($categories->get());
    }

    public function getSubcategoryParentCategories(Request $request)
    {
        $subcategory = Category::where('id', $request->subcategory_id)->first();

        $categories = array($subcategory);

        self::addParentCategory($categories, $subcategory);

        return $this->successResponse(array_reverse($categories), 200);
    }

    private static function addParentCategory(&$categories, $category){
        if($category->category_id){
            $parentCategory = Category::where('id', $category->category_id)->first();

            array_push($categories, $parentCategory);

            if($parentCategory->category_id){
                self::addParentCategory($categories, $parentCategory);
            }
        }
    }

    public function listOfCategories(Request $request)
    {
        $query = request()->query();

        $categories = Category::withCount('subcategories');

        if(isset($query['sortDirection'])){
            return $this->sort($query, $categories);
        }

        return $this->paginate($categories->get());
    }
}

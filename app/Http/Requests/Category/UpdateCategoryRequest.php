<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $category = Category::where('name', $request->name)->first();
        
        return [
            'name' => [
                'required',
                Rule::unique('categories','name')->ignore($category),
            ],
            'description' => 'required',
            'image' => 'image'
        ];
    }
}

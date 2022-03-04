<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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

        return [
            'name' => "required|unique:categories,name,{$this->category->id}",
            'description' => 'required',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The Name has Already been Taken. Please try again....',
        ];
    }
}

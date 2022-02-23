<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name',
            'description' => 'required',
            'image' => 'image'
        ];
    }

    public function messages() 
    {
      return [
        'name.unique' => 'Category Title is Taken. Please try again....',
        'name.required' => 'The Title Field is Required. Please try again....',
        'description.required' => 'The Description Field is Required. Please try again....',
      ];
    }
}

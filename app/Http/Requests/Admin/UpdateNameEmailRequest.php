<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNameEmailRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'email' => 'required|unique:users,email|string|ends_with:sun-asterisk.com,gmail.com,yahoo.com|unique:users,email,' . Auth::user()->id,
            'password' => 'required|string|min:6'
        ];
    }

    public function messages() 
    {
      return [
        'email.unique' => 'The Email is Already Taken',
        'email.ends_with' => 'Your Email is Not Valid',
        'password.min' => 'Password Must Be at Least 6 Characters'
      ];
    }
}

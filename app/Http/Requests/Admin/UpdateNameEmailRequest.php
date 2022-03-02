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
            'email' => 'required|string|ends_with:sun-asterisk.com,gmail.com,yahoo.com|unique:users,email,' . Auth::user()->id,
            'password' => 'required|string|min:6'
        ];
    }

    public function messages() 
    {
      return [
        'email.ends_with' => 'Your email is not valid',
        'password.min' => 'Password must be at least 6 characters'
      ];
    }
}

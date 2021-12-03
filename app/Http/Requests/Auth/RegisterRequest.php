<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|ends_with:sun-asterisk.com,gmail.com,yahoo.com',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
            'user_type_id' => 'required|integer'
        ];
    }

    public function messages() 
    {
      return [
        'email.ends_with' => 'Your email is not valid',
        'password_confirmation.same' => 'Password does not match',
        'password.min' => 'Password must be at least 6 characters'
      ];
    }
}

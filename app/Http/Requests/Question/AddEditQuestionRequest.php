<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class AddEditQuestionRequest extends FormRequest
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
            'question_type_id' => 'required|integer',
            'quiz_id' => 'required|integer',
            'question' => 'required|string',
            'time_limit' => 'required|integer',
            'text_answer' => 'required|string',
            // 'choice' => 'required',
            // 'question_id' => 'required',
            // 'is_correct' => 'required',
        ];
    }
}

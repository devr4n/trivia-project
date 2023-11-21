<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TriviaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Form validation rules
        return [
            'full_name' => 'required',
            'email' => 'required|email',
            'number_of_questions' => 'required|integer|max:50',
            'difficulty' => 'required|in:easy,medium,hard',
            'type' => 'required|in:multiple,boolean',
        ];
    }
}

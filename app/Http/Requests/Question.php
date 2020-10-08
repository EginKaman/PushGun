<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Question extends FormRequest
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
            'email' => ['required', 'email', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'message' => ['required', 'min:10'],
            'accepted' => ['required', 'accepted']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'emails' => ['nullable', 'array'],
            'emails.*' => ['email'],
            'numbers' => ['nullable', 'array'],
            'numbers.*' => ['integer'],
            'addressbook_id' => ['required', 'exists:address_books,id']
        ];
    }
}

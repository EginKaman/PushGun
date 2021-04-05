<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailMailingCreateRequest extends FormRequest
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
            'preheader' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5128'],

            'address_book_id' => ['required', 'exists:address_books,id'],
            'subject' => ['required', 'string'],
            'sender_name' => ['required', 'string'],
            'date_send' => ['nullable', 'date'],
            'body' => ['nullable', 'string']
        ];
    }
}

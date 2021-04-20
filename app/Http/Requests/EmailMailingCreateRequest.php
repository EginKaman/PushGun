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
            'file' => ['nullable', 'file'],
            'address_book_id' => ['required', 'exists:address_books,id'],
            'email_sender_id' => ['required', 'exists:email_senders,id'],
            'subject' => ['required', 'string'],
            'date_send' => ['nullable', 'date'],
            'body' => ['nullable', 'string']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsMessageStoreRequest extends FormRequest
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
            'sms_sender_id' => ['nullable', 'exists:sms_senders,id'],
            'text' => ['required', 'string'],
            'date_send' => ['nullable', 'date'],
            'contacts' => ['nullable', 'array'],
            'contacts.*' => ['integer'],
            'address_book_id' => ['nullable', 'exists:address_books,id'],
        ];
    }
}

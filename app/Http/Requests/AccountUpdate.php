<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdate extends FormRequest
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
            'name' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'phone' => 'phone',
            'email' => 'sometimes|required|email',
            'lang' => 'string|max:255',
            'timezone' => 'string|max:255',
            'country' => 'string|max:255',
            'city' => 'string|max:255',
            'address' => 'string|max:255',
            'postcode' => 'string|max:255',
            'photo' => 'image|max:5124',
        ];
    }
}

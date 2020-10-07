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
            'lastname' => 'nullable|string|max:255',
            'phone' => 'nullable|phone:AUTO,mobile',
            'email' => 'sometimes|required|email',
            'lang' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5124',
        ];
    }
}

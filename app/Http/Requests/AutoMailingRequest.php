<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoMailingRequest extends FormRequest
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
            'days' => 'required|array',
            'hours' => 'string',
            'minute' => 'string',
            'utm_source' => 'string|nullable',
            'utm_medium' => 'string|nullable',
            'utm_compaign' => 'string|nullable',
            'sites'=>'required|array',
            'pushes'=>'required|array',
        ];
    }
}

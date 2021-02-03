<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoMailingUpdate extends FormRequest
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
            'days' => 'sometimes|required|array',
            'hours' => 'sometimes|string',
            'minute' => 'sometimes|string',
            'utm_source' => 'sometimes|string|nullable',
            'utm_medium' => 'sometimes|string|nullable',
            'utm_compaign' => 'sometimes|string|nullable',
            'sites'=>'sometimes|required|array',
            'status_id'=>'sometimes|integer',
            'pushes'=>'sometimes|required|array',
            'name'=>'sometimes|required|string'
        ];
    }
}

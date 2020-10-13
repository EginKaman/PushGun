<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('site')->user_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['nullable', 'image'],
            'request' => ['required', 'string', Rule::in(['visit', 'click', 'intermediate'])],
            'hint' => ['nullable', 'boolean'],
            'mobile' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Обязательно загрузите изображение для сайта',
            'image.image' => 'Обязательно загрузите изображение для сайта'
        ];
    }
}

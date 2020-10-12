<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteStore extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'link' => "{$this->protocol}://{$this->domain}",
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => 'required|url|unique:sites,link',
            'image' => ['nullable', 'image'],
            'request' => ['nullable', 'string', Rule::in(['visit', 'click', 'intermediate'])],
            'hint' => ['nullable', 'boolean'],
            'mobile' => ['nullable', 'boolean'],
            'delay' => ['nullable', 'digits_between:0,65535']
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'Поле Адрес сайта обязательно',
            'link.unique' => 'Значение поля Адрес сайта не должно повторяться в базе данных',
            'image.required' => 'Обязательно загрузите изображение для сайта',
            'image.image' => 'Обязательно загрузите изображение для сайта'
        ];
    }
}

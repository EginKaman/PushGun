<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'Поле Адрес сайта обязательно',
            'link.unique' => 'Значение поля Адрес сайта не должно повторяться в базе данных',
            'siteAvatar.required' => 'Обязательно загрузите изображение для сайта',
            'siteAvatar.file' => 'Обязательно загрузите изображение для сайта'
        ];
    }
}

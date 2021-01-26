<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PushStore extends FormRequest
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
            'title' => 'required|string|max:30',
            'text' => 'required|max:130',
            'link' => 'required|url',
            'icon' => ['nullable', 'image', 'max:1024'],
            'image' => ['nullable', 'image', 'max:5128'],
            'sites' => ['required', 'array', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле Заголовок обязательно',
            'text.required' => 'Поле Текст уведомления обязательно',
            'link.required' => 'Поле Ссылка на уведомление обязательно',
            'site_id.required' => 'Поле Список получателей обязательно',
            'site_id.exists' => 'Поле Список получателей имеет недопустимое значение',
            'link.url' => 'Поле Ссылка на уведомление должно быть в виде URL'
        ];
    }
}

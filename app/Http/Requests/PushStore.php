<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'text' => 'required',
            'link' => 'required|url',
            'image' => 'image',
            'site' => 'required|exists:sites,id'
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

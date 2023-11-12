<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize (): bool
    {
        return true;
    }

    public function rules (): array
    {
        return [
            'title' => 'required|max:255',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'nullable|exists:branches,id',
        ];
    }

    public function messages (): array
    {
        return [
            'title.required' => 'Заголовок обязателен',
            'title.max' => 'Заголовок должен быть меньше 255 символов',
            'section_id.required' => 'Секция обязательна',
            'section_id.exists' => 'Секция не найдена',
            'parent_id.exists' => 'Ветка не найдена',
        ];
    }

}

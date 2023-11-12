<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

}

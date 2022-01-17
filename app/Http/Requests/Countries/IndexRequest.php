<?php

namespace App\Http\Requests\Countries;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters' => ['bail', 'filled', 'array'],
            'filters.name' => ['bail', 'nullable', 'string', 'min:2', 'max:80'],
            'filters.status_enabled' => ['bail', 'nullable', 'in:enabled,disabled'],
        ];
    }
}

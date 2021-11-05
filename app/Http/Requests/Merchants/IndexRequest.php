<?php

namespace App\Http\Requests\Merchants;

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
            'filters' => ['filled', 'array'],
            'filters.name' => ['filled', 'string', 'min:2', 'max:120'],
        ];
    }
}

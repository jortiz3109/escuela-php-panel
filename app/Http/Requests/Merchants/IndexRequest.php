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
            'filters'          => ['filled', 'array'],
            'filters.multiple' => ['filled', 'min:2', 'max:255'],
        ];
    }
}

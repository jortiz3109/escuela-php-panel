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
            'filters.name'     => ['nullable', 'string', 'min:2', 'max:120'],
            'filters.brand'    => ['nullable', 'string', 'min:2', 'max:120'],
            'filters.document' => ['nullable', 'string', 'min:2', 'max:30'],
            'filters.url'      => ['nullable', 'string', 'min:2', 'max:200'],
            'filters.country'  => ['nullable', 'string', 'min:2', 'max:80'],
            'filters.currency' => ['nullable', 'string', 'min:2', 'max:80'],
        ];
    }
}

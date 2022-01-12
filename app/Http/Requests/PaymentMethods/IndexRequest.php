<?php

namespace App\Http\Requests\PaymentMethods;

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
            'filters.status_enabled' => ['bail', 'nullable', 'in:enabled,disabled'],
            'filters.name' => ['bail', 'nullable', 'min:3', 'string'],
        ];
    }
}

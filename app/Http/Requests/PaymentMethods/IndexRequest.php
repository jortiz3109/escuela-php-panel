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
            'filters.status' => ['bail', 'nullable', 'bool'],
            'filters.name' => ['bail', 'nullable', 'exists:payment_methods,name'],
        ];
    }
}

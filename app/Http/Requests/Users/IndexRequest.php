<?php

namespace App\Http\Requests\Users;
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
            'filters.email' => ['email'],
            'filters.name' => ['string', 'max:120'],
            'filters.enabled_at' => ['boolean'],
        ];
    }
}




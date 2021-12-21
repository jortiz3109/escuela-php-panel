<?php

namespace App\Http\Requests\Permissions;

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
            'filters' => ['bailed', 'filled', 'array'],
            'filters.name' => ['bailed', 'filled', 'string', 'min:2', 'max:125'],
        ];
    }
}

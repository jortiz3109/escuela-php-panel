<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'min:2', 'max:125'],
            'description' => ['bail', 'required', 'string', 'min:2', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'regex:/^[a-zA-Z\s]*$/', 'min:2', 'max:255'],
            'email' => [
                'bail',
                'required',
                'email',
                'min:2',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
        ];
    }
}

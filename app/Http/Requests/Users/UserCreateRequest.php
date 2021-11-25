<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/u' ],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users', 'email')->ignore($this->users)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}

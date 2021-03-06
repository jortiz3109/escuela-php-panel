<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rules\Password;

class StoreRequest extends UpdateRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), ['password' => ['required', 'confirmed', Password::defaults()]]);
    }
}

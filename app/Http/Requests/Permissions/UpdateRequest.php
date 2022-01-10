<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $permission = $this->route('permission');

        return $permission && $this->user()->can('update', $permission);
    }

    public function rules(): array
    {
        return [
            'description' => ['bail', 'required', 'string', 'min:2', 'max:255'],
        ];
    }
}

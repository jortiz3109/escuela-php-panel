<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.unique' => 'El :attribute debe unico',
            'password.required' => 'El :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del usuari0',
            'email' => 'email del usuario',
            'password' => 'password del usuario',
        ];
    }
}

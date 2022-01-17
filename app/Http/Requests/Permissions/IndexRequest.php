<?php

namespace App\Http\Requests\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Permission::class);
    }

    public function rules(): array
    {
        return [
            'filters' => ['bail', 'filled', 'array'],
            'filters.name' => ['bail', 'filled', 'string', 'min:2', 'max:125'],
        ];
    }
}

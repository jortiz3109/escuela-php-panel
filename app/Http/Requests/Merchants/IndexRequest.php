<?php

namespace App\Http\Requests\Merchants;

use App\Models\Merchant;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Merchant::class);
    }

    public function rules(): array
    {
        return [
            'filters' => ['bail', 'filled', 'array'],
            'filters.merchant_query' => ['bail', 'nullable', 'min:2', 'max:120'],
            'filters.country' => ['bail', 'nullable'],
            'filters.currency' => ['bail', 'nullable'],
        ];
    }
}

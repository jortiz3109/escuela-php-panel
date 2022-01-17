<?php

namespace App\Http\Requests\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Transaction::class);
    }

    public function rules(): array
    {
        return [
            'filters' => ['bail', 'filled', 'array'],
            'filters.status' => ['bail', 'nullable'],
            'filters.merchant' => ['bail', 'nullable', 'min:2', 'max:120'],
            'filters.reference' => ['bail', 'nullable', 'min:2', 'max:120'],
            'filters.payment_method' => ['bail', 'nullable', 'exists:payment_methods,id'],
            'filters.dates' => ['bail', 'nullable', 'array:0,1'],
            'filters.dates.*' => ['bail', 'date'],
        ];
    }
}

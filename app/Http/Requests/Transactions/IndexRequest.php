<?php

namespace App\Http\Requests\Transactions;

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
            'filters'          => ['filled', 'array'],
            'filters.status'  => ['nullable'],
            'filters.merchant' => ['nullable', 'min:2', 'max:120'],
            'filters.reference' => ['nullable', 'min:2', 'max:120'],
            'filters.payment_method' => ['nullable'],
            'filters.date' => ['nullable', 'array:0,1'],
            'filters.date.*' => ['date'],
        ];
    }

    protected function prepareForValidation()
    {
        $date = $this->filters['date'] ?? null;

        if ($date) {
            $this->merge([
                'filters' => array_replace($this->input('filters'), [
                    'date' => explode(' - ', $date),
                ]),
            ]);
        }
    }
}

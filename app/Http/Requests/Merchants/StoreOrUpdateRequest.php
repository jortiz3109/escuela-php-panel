<?php

namespace App\Http\Requests\Merchants;

use App\Rules\ValidUrlRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:120'],
            'brand' => ['bail', 'required', 'string', 'max:120'],
            'document' => [
                'bail',
                'required',
                'string',
                'max:30',
                Rule::unique('merchants')->where(
                    fn ($query) => $query
                        ->where('document', $this->input('document'))
                        ->where('document_type_id', $this->input('document_type_id'))
                )
                    ->ignore($this->route('merchant')),
            ],
            'url' => ['bail', 'nullable', 'url', 'max:90', new ValidUrlRule()],
            'country_id' => [
                'bail',
                'required',
                'numeric',
                Rule::exists('countries', 'id')->whereNotNull('enabled_at'),
            ],
            'currency_id' => [
                'bail',
                'required',
                'numeric',
                Rule::exists('currencies', 'id')->whereNotNull('enabled_at'),
            ],
            'document_type_id' => ['bail', 'required', 'numeric', 'exists:document_types,id'],
        ];
    }
}

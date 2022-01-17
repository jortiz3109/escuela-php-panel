<?php

namespace App\Http\Requests\Merchants;

class UpdateRequest extends StoreRequest
{
    public function authorize(): bool
    {
        $merchant = $this->route('merchant');

        return $merchant && $this->user()->can('update', $merchant);
    }
}

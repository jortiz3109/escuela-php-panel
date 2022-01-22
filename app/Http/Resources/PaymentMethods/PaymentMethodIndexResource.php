<?php

namespace App\Http\Resources\PaymentMethods;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodIndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'url' => route('payment-methods.status.toggle', $this->resource),
            'enabled' => $this->resource->isEnabled(),
            'button_enabled' => true,
        ]);
    }
}

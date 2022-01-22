<?php

namespace App\Http\Resources\Currencies;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyIndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'url' => route('currencies.status.toggle', $this->resource),
            'enabled' => $this->resource->isEnabled(),
            'button_enabled' => true,
        ]);
    }
}

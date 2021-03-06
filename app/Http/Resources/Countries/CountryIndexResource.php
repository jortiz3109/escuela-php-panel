<?php

namespace App\Http\Resources\Countries;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryIndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'url' => route('countries.status.toggle', $this->resource),
            'enabled' => $this->resource->isEnabled(),
            'button_enabled' => true,
        ]);
    }
}

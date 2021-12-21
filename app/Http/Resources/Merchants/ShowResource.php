<?php

namespace App\Http\Resources\Merchants;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    public function toArray($request = null)
    {
        $docType = $this->resource->documentType->code;
        $doc = $this->resource->document;
        return [
            'name' => $this->resource->name,
            'document' => $docType . ': ' . $doc,
            'brand' => $this->resource->brand,
            'country' => $this->resource->country->name,
            'currency' => $this->resource->currency->alphabetic_code,
            'url' => $this->resource->url,
        ];
    }
}

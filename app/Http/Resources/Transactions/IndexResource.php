<?php

namespace App\Http\Resources\Transactions;

use App\Helpers\AmountHelper;
use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'date' => DateHelper::toDateString($this->date),
            'total_amount' => AmountHelper::format($this->total_amount, $this->currency),
        ]);
    }
}

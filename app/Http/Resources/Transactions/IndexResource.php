<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'date' => $this->executed_at->toDateString(),
            'merchant' => $this->merchant,
            'reference' => $this->reference,
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
        ];
    }
}

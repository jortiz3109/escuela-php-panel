<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'date' => $this->executed_at->toDateString(),
            'merchant' => $this->merchant->name,
            'currency' => $this->currency->alphabetic_code,
            'total_amount' => $this->total_amount,
            'payment_method' => $this->paymentMethod->name,
            'status' => $this->status,
        ];
    }
}

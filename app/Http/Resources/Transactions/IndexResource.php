<?php

namespace App\Http\Resources\Transactions;

use App\Helpers\AmountHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'date' => $this->executed_at->toDateString(),
            'merchant' => $this->merchant,
            'reference' => $this->reference,
            'currency' => $this->currency,
            'total_amount' => AmountHelper::format($this->total_amount, $this->currency),
            'payment_method' => $this->payment_method,
            'status' => $this->status,
        ];
    }
}

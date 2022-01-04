<?php

namespace App\Http\Resources\Transactions;

use App\Helpers\AmountHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionShowResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'merchant' => $this->resource->merchant->name,
            'reference' => $this->resource->reference,
            'payment_method' => $this->resource->paymentMethod->logo,
            'card_number' => $this->resource->card_number,
            'currency' => $this->resource->currency->name . ' (' . $this->resource->currency->alphabetic_code . ')',
            'total_amount' => AmountHelper::format(
                $this->resource->total_amount,
                $this->resource->currency->alphabetic_code
            ),
            'status' => $this->resource->status,
            'ip_address' => $this->resource->ip_address,
            'executed_at' => $this->resource->executed_at,
            'geolocation' => $this->resource->ip_address,
            'payer_name' => $this->resource->payer->name,
            'payer_email' => $this->resource->payer->email,
            'buyer_name' => $this->resource->buyer->name,
            'buyer_email' => $this->resource->buyer->email,
        ];
    }
}

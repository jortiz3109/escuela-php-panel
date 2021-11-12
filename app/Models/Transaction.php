<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'buyer_id');
    }

    public function payer(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'payer_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}

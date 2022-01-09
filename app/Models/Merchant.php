<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use App\Presenters\MerchantPresenter;
use Database\Factories\MerchantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static MerchantFactory factory(...$parameters)
 */
class Merchant extends Model
{
    use HasFactory;
    use HasFilters;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function presenter(): MerchantPresenter
    {
        return new MerchantPresenter($this);
    }
}

<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder enabled()
 */
class Currency extends Model
{
    use HasEnabled;
    use HasFactory;
    use HasFilters;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'minor_unit',
        'alphabetic_code',
        'symbol',
    ];
}

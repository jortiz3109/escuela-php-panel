<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use App\Models\Concerns\HasToggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder enabled()
 */
class Country extends Model
{
    use HasEnabled;
    use HasFactory;
    use HasFilters;
    use HasToggle;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'alpha_two_code',
        'alpha_three_code',
        'numeric_code',
    ];
}

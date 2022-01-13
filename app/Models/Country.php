<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    use HasFilters;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'alpha_two_code',
        'alpha_three_code',
        'numeric_code',
    ];
}

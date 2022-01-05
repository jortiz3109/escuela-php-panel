<?php

namespace App\Models;

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

    public $timestamps = false;
    protected $guarded = [];
}

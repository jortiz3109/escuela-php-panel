<?php

namespace App\Models;

use App\Models\Concerns\HasToggle;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasToggle;

    public $timestamps = false;
    protected $guarded = [];
}

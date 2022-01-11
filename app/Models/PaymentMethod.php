<?php

namespace App\Models;

use App\Models\Concerns\HasToggle;
use App\Models\Contracts\ToggleInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model implements ToggleInterface
{
    use HasToggle;
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contracts\ToggleInterface;

class ToggleController extends Controller
{
    public function toggle(ToggleInterface $toggle): ToggleInterface
    {
        $toggle->toggle();

        return $toggle;
    }
}

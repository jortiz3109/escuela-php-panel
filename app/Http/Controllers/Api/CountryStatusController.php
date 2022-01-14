<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryStatusController extends Controller
{
    public function toggle(Country $country): JsonResponse
    {
        $country->toggle();

        return response()->json([
            'enabled_at' => $country->isEnabled(),
            'message' => trans('common.responses.updated', ['model' => 'country']),
        ]);
    }
}

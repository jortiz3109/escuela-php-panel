<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\JsonResponse;

class CurrencyStatusController extends Controller
{
    public function toggle(Currency $currency): JsonResponse
    {
        $currency->toggle();

        return response()->json([
            'enabled_at' => $currency->isEnabled(),
            'message' => trans('common.responses.updated', ['model' => 'currency']),
        ]);
    }
}

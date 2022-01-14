<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;

class PaymentMethodStatusController extends Controller
{
    public function toggle(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->toggle();

        return response()->json([
            'enabled_at' => $paymentMethod->isEnabled(),
            'message' => trans('common.responses.updated', ['model' => 'payment method']),
        ]);
    }
}

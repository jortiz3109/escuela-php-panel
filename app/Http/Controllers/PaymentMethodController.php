<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethods\IndexRequest;
use App\Models\PaymentMethod;
use App\ViewModels\PaymentMethods\PaymentMethodsIndexViewModel;
use Illuminate\View\View;

class PaymentMethodController extends Controller
{
    public function index(IndexRequest $request, PaymentMethodsIndexViewModel $viewModel): View
    {
        $paymentMethods = PaymentMethod::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($paymentMethods));
    }
}

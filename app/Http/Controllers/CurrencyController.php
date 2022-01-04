<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\ViewModels\Currencies\CurrencyIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(Request $request, CurrencyIndexViewModel $viewModel): View
    {
        $currencies = Currency::filter($request->input('filters', []))->paginate();

        return view('currencies.index', $viewModel->collection($currencies));
    }
}

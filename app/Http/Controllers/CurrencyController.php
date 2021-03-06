<?php

namespace App\Http\Controllers;

use App\Http\Requests\Currencies\IndexRequest;
use App\Models\Currency;
use App\ViewModels\Currencies\CurrencyIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Currency::class, 'currency');
    }

    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, CurrencyIndexViewModel $viewModel): View
    {
        $currencies = Currency::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($currencies));
    }
}

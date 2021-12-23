<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\MerchantIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class MerchantController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, MerchantIndexViewModel $viewModel): View
    {
        $merchants = Merchant::filter($request->input('filters', []))->paginate();

        $viewModel->collection($merchants);

        return view('merchants.index', $viewModel->toArray());
    }
}

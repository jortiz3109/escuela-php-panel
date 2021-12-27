<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\MerchantIndexViewModel;
use App\ViewModels\Merchants\MerchantCreateViewModel;
use App\ViewModels\Merchants\MerchantEditViewModel;
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

        return view('merchants.index', $viewModel->collection($merchants));
    }

    public function create(MerchantCreateViewModel $viewModel): View
    {
        return view('modules.create', $viewModel);
    }

    public function edit(Merchant $merchant, MerchantEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($merchant));
    }
}

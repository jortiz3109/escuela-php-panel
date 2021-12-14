<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\MerchantsCreateViewModel;
use App\ViewModels\Merchants\MerchantsEditViewModel;
use App\ViewModels\Merchants\MerchantsIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MerchantController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, MerchantsIndexViewModel $viewModel): View
    {
        $merchants = Merchant::filter($request->input('filters', []))->paginate();

        $viewModel->collection($merchants);

        return view('merchants.index', $viewModel);
    }

    public function create(MerchantsCreateViewModel $viewModel): View
    {
        return view('layouts.create', $viewModel);
    }

    public function edit(Merchant $merchant): View
    {
        $viewModel = new MerchantsEditViewModel($merchant);

        return view('layouts.edit', $viewModel);
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Create logic to store merchant.

        return redirect()->route('merchants.index');
    }

    public function update(Merchant $merchant, Request $request): RedirectResponse
    {
        // TODO: Create logic to edit merchant.

        return redirect()->route('merchants.index');
    }
}

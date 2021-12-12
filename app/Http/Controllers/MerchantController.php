<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\MerchantsCreateOrEditViewModel;
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

    public function create(): View
    {
        $viewModel = new MerchantsCreateOrEditViewModel();

        return view('layouts.create_or_edit', $viewModel);
    }

    public function edit(Merchant $merchant): View
    {
        $viewModel = new MerchantsCreateOrEditViewModel($merchant);

        return view('layouts.create_or_edit', $viewModel);
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

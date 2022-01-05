<?php

namespace App\Http\Controllers;

use App\Actions\Merchants\MerchantStoreAction;
use App\Actions\Merchants\MerchantUpdateAction;
use App\Http\Requests\Merchants\IndexRequest;
use App\Http\Requests\Merchants\StoreRequest;
use App\Http\Requests\Merchants\UpdateRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\MerchantCreateViewModel;
use App\ViewModels\Merchants\MerchantEditViewModel;
use App\ViewModels\Merchants\MerchantIndexViewModel;
use App\ViewModels\Merchants\MerchantShowViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
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
        return view('modules.create', $viewModel->model(new Merchant()));
    }

    public function store(StoreRequest $request, MerchantStoreAction $action): RedirectResponse
    {
        $merchant = $action->execute(new Merchant(), $request);

        return redirect($merchant->presenter()->show())
            ->with('success', trans('merchants.alerts.successful_create'));
    }

    public function edit(Merchant $merchant, MerchantEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($merchant));
    }

    public function update(Merchant $merchant, UpdateRequest $request, MerchantUpdateAction $action): RedirectResponse
    {
        $merchant = $action->execute($merchant, $request);

        return redirect($merchant->presenter()->show())
            ->with('success', trans('merchants.alerts.successful_update'));
    }

    public function show(Merchant $merchant, MerchantShowViewModel $viewModel): View
    {
        $viewModel->model($merchant->load('documentType'));

        return view('modules.show', $viewModel);
    }
}

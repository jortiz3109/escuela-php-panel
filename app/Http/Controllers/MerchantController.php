<?php

namespace App\Http\Controllers;

use App\Actions\Merchants\MerchantStoreOrUpdateAction;
use App\Http\Requests\Merchants\IndexRequest;
use App\Http\Requests\Merchants\StoreOrUpdateRequest;
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

    public function store(StoreOrUpdateRequest $request, MerchantStoreOrUpdateAction $action): RedirectResponse
    {
        $merchant = $action->execute(new Merchant(), $request);

        return redirect()
            ->route('merchants.show', $merchant)
            ->with('success', trans('common.alerts.created', ['entityName' => trans('merchants.entityName')]));
    }

    public function edit(Merchant $merchant, MerchantEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($merchant));
    }

    public function update(
        Merchant $merchant,
        StoreOrUpdateRequest $request,
        MerchantStoreOrUpdateAction $action
    ): RedirectResponse {
        $merchant = $action->execute($merchant, $request);

        return redirect()
            ->route('merchants.show', $merchant)
            ->with('success', trans('common.alerts.updated', ['entityName' => trans('merchants.entityName')]));
    }

    public function show(Merchant $merchant, MerchantShowViewModel $viewModel): View
    {
        $viewModel->model($merchant->load('documentType'));

        return view('modules.show', $viewModel);
    }
}

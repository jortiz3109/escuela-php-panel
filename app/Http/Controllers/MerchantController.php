<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\IndexViewModel;
use App\ViewModels\Merchants\ShowViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class MerchantController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, IndexViewModel $viewModel): View
    {
        $merchants = Merchant::filter($request->input('filters', []))->paginate();

        $viewModel->collection($merchants);

        return view('merchants.index', $viewModel->toArray());
    }

    public function show(Merchant $merchant, ShowViewModel $viewModel): View
    {
        $viewModel->model($merchant);

        return view('layouts.show', $viewModel);
    }
}

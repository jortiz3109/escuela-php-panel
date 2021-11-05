<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchants\IndexRequest;
use App\Models\Merchant;
use App\ViewModels\Merchants\IndexViewModel;
use Illuminate\View\View;

class MerchantController extends Controller
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, IndexViewModel $viewModel): View
    {
        $merchants = Merchant::filter($request->input('filters', []))
            ->with('country', 'currency')
            ->paginate();

        $viewModel->collection($merchants);

        return view('merchants.index', $viewModel->toArray());
    }
}

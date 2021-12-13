<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transactions\IndexRequest;
use App\Models\Transaction;
use App\ViewModels\Transactions\DetailsViewModel;
use App\ViewModels\Transactions\IndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, IndexViewModel $viewModel): View
    {
        $transactions = Transaction::filter($request->safe()->collect()->get('filters', []))->paginate();
        $viewModel->collection($transactions);

        return view('modules.index', $viewModel->toArray());
    }

    public function show(Transaction $transaction, DetailsViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

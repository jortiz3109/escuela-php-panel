<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transactions\IndexRequest;
use App\Models\Transaction;
use App\ViewModels\Transactions\TransactionDetailsViewModel;
use App\ViewModels\Transactions\TransactionIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('date_between')->only('index');
    }

    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, TransactionIndexViewModel $viewModel): View
    {
        $transactions = Transaction::filter($request->safe()->collect()->get('filters', []))->paginate();
        $viewModel->collection($transactions);

        return view('modules.index', $viewModel->toArray());
    }

    public function show(Transaction $transaction, TransactionDetailsViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

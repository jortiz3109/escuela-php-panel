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

        $this->authorizeResource(Transaction::class, 'transaction');
    }

    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, TransactionIndexViewModel $viewModel): View
    {
        $transactions = Transaction::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($transactions));
    }

    public function show(Transaction $transaction, TransactionDetailsViewModel $viewModel): View
    {
        return view('transactions.show', $viewModel->model($transaction));
    }
}

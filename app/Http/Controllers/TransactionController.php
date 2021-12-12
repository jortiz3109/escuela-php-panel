<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\ViewModels\Transactions\DetailsViewModel;
use App\ViewModels\Transactions\IndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(Request $request, IndexViewModel $viewModel): View
    {
        $transactions = Transaction::filter($request->input('filters', []))->paginate();
        $viewModel->collection($transactions);

        return view('modules.index', $viewModel->toArray());
    }

    public function show(Transaction $transaction, DetailsViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

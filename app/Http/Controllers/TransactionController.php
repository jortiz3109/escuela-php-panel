<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\ViewModels\Transactions\DetailsViewModel;
use App\ViewModels\Transactions\IndexViewModel;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(IndexViewModel $viewModel): View
    {
        $transactions = Transaction::paginate();
        $viewModel->collection($transactions);

        return view('modules.index', $viewModel->toArray());
    }

    public function show(Transaction $transaction, DetailsViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

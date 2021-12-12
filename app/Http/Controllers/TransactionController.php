<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\ViewModels\Transactions\DetailsIndexViewModel;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function show(Transaction $transaction, DetailsIndexViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

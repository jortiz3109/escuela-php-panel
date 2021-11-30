<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\ViewModels\Transactions\DetailsViewModel;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function show(Transaction $transaction, DetailsViewModel $viewModel): View
    {
        $viewModel->model($transaction);

        return view('transactions.show', $viewModel->toArray());
    }
}

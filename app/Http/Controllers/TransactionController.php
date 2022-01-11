<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transactions\IndexRequest;
use App\Location\Location;
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
        $transactions = Transaction::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($transactions));
    }

    public function show(Transaction $transaction, TransactionDetailsViewModel $viewModel): View
    {
        if (!$transaction->latitude) {
            $location = resolve(Location::class);
            $latLng = $location->getLocation($transaction->ip_address);
            $transaction->latitude = $latLng['latitude'];
            $transaction->longitude = $latLng['longitude'];
            $transaction->save();
        }
        return view('transactions.show', $viewModel->model($transaction));
    }
}

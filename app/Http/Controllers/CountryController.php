<?php

namespace App\Http\Controllers;

use App\Http\Requests\Countries\IndexRequest;
use App\Models\Country;
use App\ViewModels\Countries\CountryIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, CountryIndexViewModel $viewModel): View
    {
        $countries = Country::filter($request->input('filters', []))->paginate();

        return view('countries.index', $viewModel->collection($countries));
    }
}

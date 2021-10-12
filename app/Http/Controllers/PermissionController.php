<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permissions\IndexRequest;
use App\Models\Permission;
use App\ViewModels\Permissions\IndexViewModel;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, IndexViewModel $viewModel): View
    {
        $permissions = Permission::filter($request->input('filters', []))->get();
        $viewModel->collection($permissions);

        return view('permissions.index', $viewModel->toArray());
    }
}

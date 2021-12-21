<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permissions\IndexRequest;
use App\Models\Permission;
use App\ViewModels\Permissions\PermissionIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, PermissionIndexViewModel $viewModel): View
    {
        $permissions = Permission::filter($request->input('filters', []))->paginate();

        return view('permissions.index', $viewModel->collection($permissions));
    }
}

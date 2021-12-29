<?php

namespace App\Http\Controllers;

use App\Actions\Permissions\PermissionUpdateAction;
use App\Http\Requests\Permissions\IndexRequest;
use App\Models\Permission;
use App\ViewModels\Permissions\PermissionEditViewModel;
use App\ViewModels\Permissions\PermissionIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
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

    public function edit(Permission $permission, PermissionEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($permission));
    }

    public function update(Request $request, Permission $permission, PermissionUpdateAction $action)
    {
        $action->execute($permission, $request);

        return redirect()
            ->route('permissions.index')
            ->with('success', trans('common.successful_update', ['model' => 'permission']));
    }
}

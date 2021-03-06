<?php

namespace App\Http\Controllers;

use App\Actions\Permissions\PermissionUpdateAction;
use App\Http\Requests\Permissions\IndexRequest;
use App\Http\Requests\Permissions\UpdateRequest;
use App\Models\Permission;
use App\ViewModels\Permissions\PermissionEditViewModel;
use App\ViewModels\Permissions\PermissionIndexViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }

    /**
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request, PermissionIndexViewModel $viewModel): View
    {
        $permissions = Permission::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($permissions));
    }

    public function edit(Permission $permission, PermissionEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($permission));
    }

    public function update(UpdateRequest $request, Permission $permission, PermissionUpdateAction $action)
    {
        $action->execute($permission, $request);

        return redirect()
            ->route('permissions.index')
            ->with('success', trans('permissions.alerts.successful_update'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleService $roleService
    ) {
    }

   public function index(): View
{
    $roles = $this->roleService
        ->getPaginatedRoles(
            request('search')
        );

    return view(
        'roles.index',
        compact('roles')
    );
}

    public function create(): View
    {
        return view('roles.create');
    }

    public function store(
        StoreRoleRequest $request
    ): RedirectResponse {
        $this->roleService->createRole(
            $request->validated()
        );

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role berhasil ditambahkan.'
            );
    }

    public function edit(Role $role): View
    {
        return view(
            'roles.edit',
            compact('role')
        );
    }

    public function update(
        UpdateRoleRequest $request,
        Role $role
    ): RedirectResponse {
        $this->roleService->updateRole(
            $role,
            $request->validated()
        );

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role berhasil diperbarui.'
            );
    }

    public function destroy(
        Role $role
    ): RedirectResponse {
        try {
            $this->roleService->deleteRole($role);

            return redirect()
                ->route('roles.index')
                ->with(
                    'success',
                    'Role berhasil dihapus.'
                );
        } catch (Throwable $exception) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    $exception->getMessage()
                );
        }
    }
}

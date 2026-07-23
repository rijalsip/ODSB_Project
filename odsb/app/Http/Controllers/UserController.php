<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\User\ImportUserRequest;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserTemplateExport;

class UserController extends Controller
{
    public function downloadTemplate()
{
    return Excel::download(
        new UserTemplateExport(),
        'template_import_user.xlsx'
    );
}
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function index(): View
    {
        $users = $this->userService
            ->getPaginatedUsers();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('users.create', compact('roles'));
    }

    public function store(
        StoreUserRequest $request
    ): RedirectResponse {

        $this->userService->createUser(
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }
 
    public function import(
    ImportUserRequest $request
): RedirectResponse {

    Excel::import(
        new UserImport(),
        $request->file('file')
    );

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'Import user berhasil dilakukan. Password default seluruh user adalah Telkomsel@123.'
        );
}

    public function edit(
        User $user
    ): View {

        $roles = Role::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'users.edit',
            compact(
                'user',
                'roles'
            )
        );
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ): RedirectResponse {

        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $this->userService->updateUser(
            $user,
            $data
        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }

    public function destroy(
        User $user
    ): RedirectResponse {

        $this->userService->deleteUser(
            $user
        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}
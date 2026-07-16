<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;

class RoleService
{
    public function getPaginatedRoles(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Role::query()
            ->latest()
            ->paginate($perPage);
    }

    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            return Role::create($data);
        });
    }

    public function updateRole(
        Role $role,
        array $data
    ): Role {
        return DB::transaction(function () use ($role, $data) {
            $role->update($data);

            return $role->refresh();
        });
    }

    /**
     * @throws Throwable
     */
    public function deleteRole(Role $role): void
    {
        DB::transaction(function () use ($role) {
            if ($role->users()->exists()) {
                throw new \RuntimeException(
                    'Role tidak dapat dihapus karena masih digunakan oleh user.'
                );
            }

            $role->delete();
        });
    }
}

<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Str;

class RoleService
{
    public function getPaginatedRoles(
    ?string $search = null,
    int $perPage = 10
): LengthAwarePaginator {

    return Role::query()

        ->when($search, function ($query) use ($search) {

            $query->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");

            });

        })

        ->latest()

        ->paginate($perPage)

        ->withQueryString();

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

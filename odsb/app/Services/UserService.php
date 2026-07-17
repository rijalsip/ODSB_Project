<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function getPaginatedUsers(
        int $perPage = 10
    ): LengthAwarePaginator {
        return User::query()
            ->with('role')
            ->latest()
            ->paginate($perPage);
    }

    public function createUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            return User::create($data);
        });
    }

    public function updateUser(
        User $user,
        array $data
    ): User {
        return DB::transaction(function () use ($user, $data) {
            $user->update($data);

            return $user->refresh();
        });
    }

    public function deleteUser(User $user): void
    {
        DB::transaction(function () use ($user) {
            $user->delete();
        });
    }
}
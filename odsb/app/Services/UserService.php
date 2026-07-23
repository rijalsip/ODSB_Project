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

       $data['email'] = !empty($data['id_digipos'])
    ? $data['id_digipos'] . '@digipos.local'
    : $data['username'] . '@digipos.local';
        return User::create($data);

    });
}

    public function updateUser(
    User $user,
    array $data
): User {

    return DB::transaction(function () use ($user, $data) {

        $data['email'] = !empty($data['id_digipos'])
    ? $data['id_digipos'] . '@digipos.local'
    : $data['username'] . '@digipos.local';

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

    /**
     * Cari user berdasarkan username.
     */
    public function findByUsername(
        string $username
    ): ?User {

        return User::query()
            ->with('role')
            ->where('username', $username)
            ->where('is_active', true)
            ->first();

    }

    /**
     * Cari user berdasarkan Telegram Chat ID.
     */
    public function findByTelegramChatId(
        string $chatId
    ): ?User {

        return User::query()
            ->with([
                'role',
                'sites',
            ])
            ->where('telegram_chat_id', $chatId)
            ->where('is_active', true)
            ->first();

    }

    /**
     * Hubungkan akun Telegram ke user.
     */
    public function bindTelegram(
        User $user,
        string $chatId,
        ?string $telegramUsername
    ): User {

        return DB::transaction(function () use (
            $user,
            $chatId,
            $telegramUsername
        ) {

            $user->update([

                'telegram_chat_id' => $chatId,

                'telegram_username' => $telegramUsername,

            ]);

            return $user->refresh();

        });

    }

    /**
     * Ambil seluruh Site milik user.
     */
    public function getUserSites(
        User $user
    )
    {
        return $user->sites()
            ->where('is_active', true)
            ->orderBy('site_name')
            ->get();
    }
    public function unbindTelegram(User $user): void
{
    $user->update([
        'telegram_chat_id' => null,
        'telegram_username' => null,
    ]);
}
}
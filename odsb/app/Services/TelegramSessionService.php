<?php

namespace App\Services;

use App\Models\TelegramSession;
use Carbon\Carbon;

class TelegramSessionService
{
    public function getSession(string $chatId): ?TelegramSession
    {
        return TelegramSession::where('telegram_chat_id', $chatId)
            ->first();
    }

    public function createSession(string $chatId): TelegramSession
    {
        return TelegramSession::create([
            'telegram_chat_id' => $chatId,
            'state' => null,
            'payload' => [],
            'expired_at' => Carbon::now()->addHours(2),
        ]);
    }

    public function getOrCreateSession(string $chatId): TelegramSession
    {
        return TelegramSession::firstOrCreate(
            [
                'telegram_chat_id' => $chatId,
            ],
            [
                'state' => null,
                'payload' => [],
                'expired_at' => Carbon::now()->addHours(2),
            ]
        );
    }

    public function updateState(TelegramSession $session, string $state): TelegramSession
    {
        $session->update([
            'state' => $state,
        ]);

        return $session->refresh();
    }

    public function updatePayload(TelegramSession $session, array $payload): TelegramSession
    {
        $session->update([
            'payload' => $payload,
        ]);

        return $session->refresh();
    }

    public function resetSession(TelegramSession $session): TelegramSession
{
    $session->update([
        'state' => null,
        'payload' => [],
        'expired_at' => Carbon::now()->addHours(2),
    ]);

    return $session->refresh();
}
}
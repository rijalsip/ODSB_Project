<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotService
{
    public function __construct(
        private TelegramSessionService $telegramSessionService
    ) {
    }

    public function handle(array $update): void
    {
        if (!isset($update['message'])) {
            return;
        }

        $chatId = (string) $update['message']['chat']['id'];
        $text = trim($update['message']['text'] ?? '');

        $session = $this->telegramSessionService->getOrCreateSession($chatId);

        if ($text === '/start') {

            $this->telegramSessionService->updateState(
                $session,
                'waiting_site'
            );

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Halo 👋\n\nSelamat datang di Bot Sales Monitoring.\n\nSilakan pilih Site."
            ]);

            return;
        }

        switch ($session->state) {

            case 'waiting_site':

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Session berhasil.\n\nState saat ini : waiting_site\n\nPesan yang Anda kirim : {$text}"
                ]);

                return;

            default:

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Silakan ketik /start untuk memulai."
                ]);

                return;
        }
    }
}
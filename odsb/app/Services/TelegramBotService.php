<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotService
{
    public function handle(array $update)
    {
        if (!isset($update['message'])) {
            return;
        }

        $chatId = $update['message']['chat']['id'];

        $text = $update['message']['text'] ?? '';

        if ($text == '/start') {

            Telegram::sendMessage([

                'chat_id' => $chatId,

                'text' => "Halo 👋\n\nSelamat datang di Bot Sales Monitoring.\n\nSilakan pilih menu.",

            ]);

        }

    }
}
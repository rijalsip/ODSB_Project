<?php

namespace App\Services;

use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotService
{
    public function __construct(
        private TelegramSessionService $telegramSessionService,
        private UserService $userService,
        private SiteService $siteService
    ) {
    }

    public function handle(array $update): void
    {
        // Hanya proses Message
if (!isset($update['message'])) {
    return;
}

        // Hanya proses Message
        if (!isset($update['message'])) {
            return;
        }

        $chatId = (string) $update['message']['chat']['id'];
        $text = trim($update['message']['text'] ?? '');

        $session = $this->telegramSessionService
            ->getOrCreateSession($chatId);

        /*
        |--------------------------------------------------------------------------
        | START
        |--------------------------------------------------------------------------
        */

        if ($text === '/start') {

            $user = $this->userService
                ->findByTelegramChatId($chatId);

            if ($user) {

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Halo {$user->name} 👋\n\nAkun Telegram Anda sudah terhubung.\n\nKetik /ds untuk membuat laporan."
                ]);

                return;
            }

            $this->telegramSessionService
                ->updateState($session, 'waiting_username');

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Halo 👋\n\nSelamat datang di Bot Sales Monitoring.\n\nSilakan masukkan username Anda."
            ]);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | DS
        |--------------------------------------------------------------------------
        */

        // if ($text === '/ds') {

            /*
|--------------------------------------------------------------------------
| DS
|--------------------------------------------------------------------------
*/

if ($text === '/ds') {

    $user = $this->userService
        ->findByTelegramChatId($chatId);

    if (!$user) {

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Akun Telegram belum terhubung.\n\nSilakan ketik /start."
        ]);

        return;
    }

    $this->telegramSessionService
        ->updateState($session, 'waiting_site_id');

    $this->telegramSessionService
        ->updatePayload($session, []);

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => "Masukkan Site ID.\n\nContoh:\n1001"
    ]);

    return;
}
        switch ($session->state) {

            case 'waiting_username':

                $user = $this->userService
                    ->findByUsername($text);

                if (!$user) {

                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Username tidak ditemukan.\n\nSilakan coba lagi."
                    ]);

                    return;
                }

                $telegramUsername = $update['message']['from']['username'] ?? null;

                $this->userService->bindTelegram(
                    $user,
                    $chatId,
                    $telegramUsername
                );

                $this->telegramSessionService
                    ->updateState($session, 'idle');

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "✅ Akun berhasil dihubungkan.\n\nSelamat datang {$user->name}.\n\nSekarang ketik /ds untuk membuat laporan."
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
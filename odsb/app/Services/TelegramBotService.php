<?php

namespace App\Services;

use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotService
{
    public function __construct(
    private TelegramSessionService $telegramSessionService,
    private UserService $userService,
    private SiteService $siteService,
    private ReportSalesService $reportSalesService,
    private ReportParserService $reportParserService
) {
}

    public function handle(array $update): void
    {

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
        'text' =>
            "Halo {$user->name} 👋\n\n" .
            "✅ Akun Telegram Anda sudah terhubung.\n\n" .
            "📖 Bingung cara menggunakan bot?\n" .
            "Ketik /help untuk melihat panduan penggunaan."
    ]);

    return;
}

            $this->telegramSessionService
                ->updateState($session, 'waiting_username');

            Telegram::sendMessage([
    'chat_id' => $chatId,
    'text' =>
        "👋 Selamat datang di *ODSB Sales Monitoring Bot*\n\n" .
        "Bot ini digunakan untuk mengirim laporan penjualan Site.\n\n" .
        "📖 Ketik /help untuk melihat panduan penggunaan.\n\n" .
        "Silakan masukkan *Username* Anda.",
    'parse_mode' => 'Markdown',
]);

            return;
        }
/*
|--------------------------------------------------------------------------
| HELP
|--------------------------------------------------------------------------
*/

if ($text === '/help') {

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' =>
            "📖 *Panduan ODSB Sales Monitoring Bot*\n\n" .

            "Perintah:\n" .
            "▶ /start - Memulai pelaporan\n" .
            "▶ /help - Menampilkan panduan\n" .
            "▶ /cancel - Membatalkan proses\n\n" .

            "Langkah penggunaan:\n" .
            "1️⃣ Ketik /start\n" .
            "2️⃣ Masukkan Username\n" .
            "3️⃣ Masukkan Site ID\n" .
            "4️⃣ Kirim laporan sesuai format\n" .
            "5️⃣ Tunggu konfirmasi dari bot\n\n" .

            "💡 Tips:\n" .
            "- Pastikan Site ID benar.\n" .
            "- Gunakan format laporan sesuai contoh.\n" .
            "- Jika terjadi kesalahan, gunakan /cancel lalu mulai lagi dengan /start.",
        'parse_mode' => 'Markdown'
    ]);

    return;
}

/*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/

if ($text === '/cancel') {

    $this->telegramSessionService->resetSession($session);

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' =>
            "❌ Proses dibatalkan.\n\n" .
            "Session telah direset.\n\n" .
            "Ketik /start untuk memulai kembali."
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


        switch ($session->state) {
case 'waiting_username':

    $user = $this->userService->findByUsername($text);

    if (!$user) {

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "❌ Username tidak ditemukan.\n\nSilakan masukkan username yang benar."
        ]);

        return;
    }

    $this->userService->bindTelegram(
        $user,
        $chatId,
        $update['message']['from']['username'] ?? null
    );

    $this->telegramSessionService->updatePayload($session, []);

    $this->telegramSessionService->updateState(
        $session,
        'waiting_site_id'
    );

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => "✅ Username berhasil diverifikasi.\n\nSilakan masukkan Site ID."
    ]);

    return;
            case 'waiting_site_id':

    $site = $this->siteService->findBySiteId($text);

    if (!$site) {

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "❌ Site ID tidak ditemukan.\n\nSilakan masukkan Site ID yang benar."
        ]);

        return;
    }

    $payload = [
        'site_id' => $site->id,
        'site_code' => $site->site_id,
        'site_name' => $site->site_name,
    ];

    $this->telegramSessionService->updatePayload($session, $payload);

    $this->telegramSessionService->updateState(
        $session,
        'waiting_report'
    );

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' =>
            "✅ Site ditemukan\n\n" .
            "📅 Tanggal : " . now()->format('d-m-Y') . "\n" .
            "🆔 Site ID : {$site->site_id}\n" .
            "🏢 Site Name : {$site->site_name}\n" .
            "📍 Cluster : {$site->cluster}\n" .
            "🌆 City : {$site->city}\n" .
            "📌 Status : {$site->site_focus_mtd}\n\n" .
            "Silakan kirim laporan dengan format:\n\n" .

            "renewal_trx: 0\n" .
            "renewal_rev: 0\n" .
            "voucher_trx: 0\n" .
            "voucher_rev: 0\n" .
            "sa_sp_trx: 0\n" .
            "sa_sp_rev: 0\n" .
            "sa_byu_trx: 0\n" .
            "sa_byu_rev: 0\n" .
            "mytelkomsel_trx: 0\n" .
            "halo_trx: 0\n" .
            "halo_rev: 0\n" .
            "orbit_trx: 0\n" .
            "orbit_rev: 0\n" .
            "nomor_spesial_trx: 0\n" .
            "nomor_spesial_rev: 0\n" .
            "bogem_trx: 0\n" .
            "bogem_rev: 0"
    ]);

    return;

    case 'waiting_report':

    $user = $this->userService
        ->findByTelegramChatId($chatId);

    if (!$user) {

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "❌ User tidak ditemukan.\nSilakan ketik /start."
        ]);

        $this->telegramSessionService->resetSession($session);


    }

    $payload = $session->payload;

    $result = $this->reportParserService->parse($text);

    if (!$result['success']) {

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "❌ Format laporan salah.\n\n"
                . implode("\n", $result['errors']),
        ]);

        return;
    }

    $report = $result['data'];

    $report['user_id'] = $user->id;
    $report['site_id'] = $payload['site_id'];
    $report['report_date'] = now()->toDateString();

    $this->reportSalesService->createReport($report);

Telegram::sendMessage([
    'chat_id' => $chatId,
    'text' =>
        "✅ Report berhasil disimpan.\n\n" .
        "🏢 Site : {$payload['site_code']} - {$payload['site_name']}\n" .
        "📅 Tanggal : " . now()->format('d-m-Y') . "\n\n" .
        "📊 Total TRX : {$report['total_trx']}\n" .
        "💰 Total REV : Rp " . number_format($report['total_rev'], 0, ',', '.') .
        "\n\n━━━━━━━━━━━━━━━\n" .
        "🔒 Anda telah logout.\n\n" .
        "Untuk membuat laporan baru,\nketik /start."
]);

$this->userService->unbindTelegram($user);

$this->telegramSessionService->resetSession($session);

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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
    {
        file_put_contents(
            storage_path('logs/telegram.txt'),
            json_encode($request->all(), JSON_PRETTY_PRINT)
        );

        return response()->json([
            'ok' => true
        ]);
    }
}